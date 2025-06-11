<?php
// app/Http/Controllers/PendaftaranUjianController.php
namespace App\Http\Controllers;

use App\Models\MahasiswaTerdaftar;
use App\Models\PendaftaranUjian;
use App\Models\SesiUjian;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendaftaranUjianController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data mahasiswa
        $mahasiswa = MahasiswaTerdaftar::where('nim', $request->nim_nik)
            ->where('nama_lengkap', $request->nama_lengkap)
            ->first();

        if (!$mahasiswa) {
            return back()->with('error', 'Nama dan NIM tidak terdaftar');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Cari sesi yang masih ada kuota
            $sesi = SesiUjian::where('kuota', '>', 0)
                ->whereHas('jadwal', function($query) {
                    $query->where('tanggal', '>=', now());
                })
                ->orderBy('waktu_mulai')
                ->lockForUpdate() // Lock untuk menghindari race condition
                ->first();

            if (!$sesi) {
                return back()->with('error', 'Maaf, tidak ada sesi ujian yang tersedia saat ini');
            }

            // Kurangi kuota sesi
            $sesi->decrement('kuota');

            // Simpan pendaftaran
            $pendaftaran = PendaftaranUjian::create([
                'mahasiswa_terdaftar_id' => $mahasiswa->id,
                'sesi_ujian_id' => $sesi->id,
                'jadwal_id' => $sesi->jadwal_ujian_id // Pastikan kolom ini benar, jika di SesiUjian ada jadwal_id atau jadwal_ujian_id
            ]);

            // Commit transaksi
            DB::commit();

            // Format data untuk ditampilkan
            $jadwal = $sesi->jadwal;
            $successData = [
                'message' => 'Pendaftaran ujian berhasil!',
                'jadwal' => $jadwal->nama_jadwal . ' (' . $jadwal->tanggal . ')',
                'sesi' => $sesi->nama_sesi,
                'waktu' => $sesi->waktu_mulai . ' - ' . $sesi->waktu_selesai,
                'lokasi' => 'Gedung ' . ($sesi->lokasi ?? 'Gedung Utama Kampus') // Menggunakan null coalescing operator
            ];

            return redirect()->route('pendaftaran.success')
                ->with('success', $successData);

        } catch (\Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            // Log error untuk debugging lebih lanjut
            Log::error('Pendaftaran Ujian Error: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile());
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi. (Error: ' . $e->getMessage() . ')'); // Tambahkan detail error untuk debugging sementara
        }
    }

    public function success()
    {
        if (!session('success')) {
            return redirect()->route('pendaftaran.form'); // Ganti dengan route form pendaftaran Anda
        }

        return view('pendaftaran.success');
    }
}
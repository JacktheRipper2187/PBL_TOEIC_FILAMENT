<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendaftaran;
use App\Models\JadwalUjian;
use App\Models\JadwalSertifikat;
use App\Models\Hasil; 
use App\Models\HasilToeic;
use App\Models\KonfirmasiSk;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal
        $jadwalPendaftaran = JadwalPendaftaran::with('jadwalPelaksanaans')->get();
        $ujian = JadwalUjian::orderBy('id')->get();
        $pengambilan = JadwalSertifikat::orderBy('hari_tanggal')->get();

        // Ambil daftar tanggal_ujian unik dari tabel hasil
        $tanggalList = Hasil::select('tanggal_ujian')->distinct()->orderBy('tanggal_ujian')->pluck('tanggal_ujian');

        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil NIM dari relasi mahasiswa
        $nim = $user->mahasiswa->nim ?? substr($user->email, 0, 10);

        // Ambil data hasil TOEIC berdasarkan NIM
        $hasilToeic = HasilToeic::where('nim', $nim)->get();

        // Ambil data konfirmasi SK terakhir jika ada
        $konfirmasiSkTerakhir = null;
        if ($user->mahasiswa) {
            $konfirmasiSkTerakhir = KonfirmasiSk::where('mahasiswa_id', $user->mahasiswa->id)
                ->latest()
                ->first();
        }

        return view('mahasiswa.depan', compact(
            'jadwalPendaftaran',
            'ujian',
            'pengambilan',
            'tanggalList',
            'hasilToeic',
            'konfirmasiSkTerakhir'
        ));
    }

    // Catatan: Ini bukan method controller yang tepat, perlu revisi jika ingin dipakai
    public function pendaftar()
    {
        return $this->hasMany(PendaftaranController::class, 'jadwal_id');
    }
}

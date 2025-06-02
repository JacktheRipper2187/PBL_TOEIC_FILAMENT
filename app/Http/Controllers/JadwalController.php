<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendaftaran;
use App\Models\JadwalUjian;
use App\Models\JadwalSertifikat;
use App\Models\Hasil; 
use App\Models\HasilToeic;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal
        $JadwalPendaftaran = JadwalPendaftaran::orderBy('tgl_buka')->get();
        $ujian = JadwalUjian::orderBy('tanggal')->get();
        $pengambilan = JadwalSertifikat::orderBy('hari_tanggal')->get();

        // Ambil daftar sesi unik dari tabel hasil
        $sesiList = Hasil::select('sesi')->distinct()->orderBy('sesi')->pluck('sesi');

        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil NIM dari relasi mahasiswa
        $nim = $user->mahasiswa->nim ?? substr($user->email, 0, 10);

        // Ambil data hasil TOEIC berdasarkan NIM
        $hasilToeic = HasilToeic::where('nim', $nim)->get();

        return view('mahasiswa.depan', compact(
            'JadwalPendaftaran',
            'ujian',
            'pengambilan',
            'sesiList',
            'hasilToeic'
        ));
    }

    // Catatan: Ini bukan method controller yang tepat, perlu revisi jika ingin dipakai
    public function pendaftar()
    {
        return $this->hasMany(PendaftaranController::class, 'jadwal_id');
    }
}

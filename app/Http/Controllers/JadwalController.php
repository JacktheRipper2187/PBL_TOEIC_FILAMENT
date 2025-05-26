<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendaftaran;
use App\Models\JadwalUjian;
use App\Models\JadwalSertifikat;
use App\Models\Hasil; // jangan lupa import model Hasil

class JadwalController extends Controller
{
    public function index()
    {
        $JadwalPendaftaran = JadwalPendaftaran::orderBy('tgl_buka')->get();
        $ujian = JadwalUjian::orderBy('tanggal')->get();
        $pengambilan = JadwalSertifikat::orderBy('hari_tanggal')->get();

        // Ambil daftar sesi unik untuk hasil
        $sesiList = Hasil::select('sesi')->distinct()->orderBy('sesi')->pluck('sesi');

        return view('depan', compact('JadwalPendaftaran', 'ujian', 'pengambilan', 'sesiList'));
        
        //jadwal pendaftaran
        $JadwalPendaftaran = JadwalPendaftaran::orderBy('tgl_buka')->get();
        return view('depan', compact('JadwalPendaftaran'));
    }
}

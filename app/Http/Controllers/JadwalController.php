<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendaftaran;
use App\Models\JadwalUjian;
use App\Models\JadwalSertifikat;
use App\Models\Hasil;

class JadwalController extends Controller
{
public function index()
{
    $jadwalPendaftaran = JadwalPendaftaran::orderBy('tgl_buka')->get();
    $ujian = JadwalUjian::orderBy('tanggal')->get();
    $pengambilan = JadwalSertifikat::orderBy('hari_tanggal')->get();
    $sesiList = Hasil::select('sesi')->distinct()->orderBy('sesi')->pluck('sesi');

    return view('mahasiswa.Depan', compact('jadwalPendaftaran', 'ujian', 'pengambilan', 'sesiList'));
    // Pastikan nama variabel dalam compact() sama persis dengan yang didefinisikan
}

    public function pendaftar()
    {
        return $this->hasMany(PendaftaranController::class, 'jadwal_id');
    }
}
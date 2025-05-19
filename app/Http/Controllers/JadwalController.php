<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPendaftaran;
use App\Models\JadwalUjian;
use App\Models\JadwalSertifikat;

class JadwalController extends Controller
{
    public function index()
    {
        $JadwalPendaftaran = JadwalPendaftaran::orderBy('tgl_buka')->get();
        $ujian = JadwalUjian::orderBy('tanggal')->get(); // Gunakan 'tanggal' sesuai field
        $pengambilan = JadwalSertifikat::orderBy('hari_tanggal')->get();

        return view('depan', compact('JadwalPendaftaran', 'ujian', 'pengambilan'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar; 
use App\Models\Pendaftaran;
use App\Models\JadwalPendaftaran;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim_nik' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat_asal' => 'required|string|max:255',
            'alamat_sekarang' => 'required|string|max:255',
            'kampus' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jadwal_id' => 'required|exists:jadwal_pendaftaran,id',
            // dan validasi lainnya
        ]);

        // Ambil jadwal
        $jadwal = JadwalPendaftaran::findOrFail($request->jadwal_id);

        // Cek kuota
        if ($jadwal->kuota <= 0) {
            return redirect()->back()->with('error', 'Kuota untuk jadwal ini sudah penuh.');
        }

        // Kurangi kuota
        $jadwal->decrement('kuota');

        // Simpan data pendaftar
        Pendaftar::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nim_nik' => $request->nim_nik,
            'email' => $request->email,
            'alamat_asal' => $request->alamat_asal,
            'alamat_sekarang' => $request->alamat_sekarang,
            'kampus' => $request->kampus,
            'jurusan' => $request->jurusan,
            'program_studi' => $request->program_studi,
            'jadwal_id' => $jadwal->id,
            // tambahkan upload file jika ada
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil.');
    }

    public function index()
    {
        $data = Pendaftar::all(); // ambil dari tabel pendaftar
        return view('admin.pendaftar.index', compact('data'));
    }
}

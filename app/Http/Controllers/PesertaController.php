<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim_nik' => 'required|string|max:255|unique:pesertas,nim_nik',
            'email' => 'required|email|unique:pesertas,email',
            'alamat_asal' => 'required|string|max:255',
            'alamat_sekarang' => 'required|string|max:255',
            'kampus' => 'required|string',
            'jurusan' => 'required|string',
            'program_studi' => 'required|string',
            'foto_formal' => 'nullable|image|max:2048',
            'upload_ktp' => 'nullable|image|max:2048',
            'upload_ktm' => 'nullable|image|max:2048',
        ],
        [
            'nim_nik.unique' => 'NIM/NIK ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan.']);

        
        // Simpan file jika ada
        if ($request->hasFile('foto_formal')) {
            $validated['foto_formal_path'] = $request->file('foto_formal')->store('foto_formal', 'public');
        }
        if ($request->hasFile('upload_ktp')) {
            $validated['ktp_path'] = $request->file('upload_ktp')->store('ktp', 'public');
        }
        if ($request->hasFile('upload_ktm')) {
            $validated['ktm_path'] = $request->file('upload_ktm')->store('ktm', 'public');
        }

        // Simpan data peserta ke DB
        Peserta::create($validated);

        // Jika request AJAX, kirim response JSON
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        // Redirect jika non-AJAX
        return redirect()->route('pendaftaran.success');
    }
}

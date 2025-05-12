<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta; 
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_lengkap', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%");
            });
        }

        $peserta = $query->paginate(5);
        $peserta->appends($request->all());

        return view('peserta.index', compact('peserta'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nim_nik' => 'required|string|max:50',
        'email' => 'required|email|unique:peserta,email',
        'alamat_asal' => 'nullable|string',
        'alamat_sekarang' => 'nullable|string',
        'kampus' => 'nullable|string|max:100',
        'jurusan' => 'nullable|string|max:100',
        'program_studi' => 'nullable|string|max:100',
        'foto_formal' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'upload_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'upload_ktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    try {
        // Upload file
        $fotoFormal = $request->file('foto_formal')?->store('foto_formal', 'public');
        $uploadKtp = $request->file('upload_ktp')?->store('upload_ktp', 'public');
        $uploadKtm = $request->file('upload_ktm')?->store('upload_ktm', 'public');

        // Create peserta
        Peserta::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nim_nik' => $request->nim_nik,
            'email' => $request->email,
            'alamat_asal' => $request->alamat_asal,
            'alamat_sekarang' => $request->alamat_sekarang,
            'kampus' => $request->kampus,
            'jurusan' => $request->jurusan,
            'program_studi' => $request->program_studi,
            'foto_formal' => $fotoFormal,
            'upload_ktp' => $uploadKtp,
            'upload_ktm' => $uploadKtm,
        ]);

        // Hanya return JSON response untuk AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil! Silakan tunggu informasi jadwal melalui email.'
            ]);
        }

        // Fallback untuk non-AJAX (seharusnya tidak terjadi jika form menggunakan AJAX)
        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil!'
        ]);

    } catch (\Exception $e) {
        // Error handling untuk AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'errors' => $e->getMessage()
            ], 500);
        }

        // Fallback error handling untuk non-AJAX
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: '.$e->getMessage()
        ], 500);
    }
}

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('peserta.edit', compact('peserta'));
    }

    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim_nik' => 'required|string|max:50',
            'email' => 'required|email|unique:peserta,email,' . $peserta->id,
            'alamat_asal' => 'nullable|string',
            'alamat_sekarang' => 'nullable|string',
            'kampus' => 'nullable|string|max:100',
            'jurusan' => 'nullable|string|max:100',
            'program_studi' => 'nullable|string|max:100',
            'foto_formal' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'upload_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'upload_ktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $data = $request->only([
                'nama_lengkap', 'nim_nik', 'email',
                'alamat_asal', 'alamat_sekarang',
                'kampus', 'jurusan', 'program_studi'
            ]);

            // Upload file baru jika ada
            if ($request->hasFile('foto_formal')) {
                // Hapus file lama jika ada
                if ($peserta->foto_formal) {
                    Storage::disk('public')->delete($peserta->foto_formal);
                }
                $data['foto_formal'] = $request->file('foto_formal')->store('foto_formal', 'public');
            }
            if ($request->hasFile('upload_ktp')) {
                if ($peserta->upload_ktp) {
                    Storage::disk('public')->delete($peserta->upload_ktp);
                }
                $data['upload_ktp'] = $request->file('upload_ktp')->store('upload_ktp', 'public');
            }
            if ($request->hasFile('upload_ktm')) {
                if ($peserta->upload_ktm) {
                    Storage::disk('public')->delete($peserta->upload_ktm);
                }
                $data['upload_ktm'] = $request->file('upload_ktm')->store('upload_ktm', 'public');
            }

            $peserta->update($data);

            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data peserta berhasil diupdate!'
                ]);
            }

            // Response untuk non-AJAX
            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diupdate!');

        } catch (\Exception $e) {
            // Error handling untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengupdate data',
                    'errors' => $e->getMessage()
                ], 500);
            }

            // Error handling untuk non-AJAX
            return back()->withInput()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
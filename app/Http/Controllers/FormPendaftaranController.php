<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\MahasiswaTerdaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FormPendaftaranController extends Controller
{
    public function showForm()
    {
        $pendaftars = Pendaftar::all(); // Fetch all registrants if needed
        return view('formpendaftaran', compact('pendaftars'));
    }

    public function submitForm(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nim_nik' => 'required|string|max:15|regex:/^\d+$/',
                'email' => 'required|email|max:255',
                'alamat_asal' => 'required|string',
                'alamat_sekarang' => 'required|string',
                'kampus' => 'required|string',
                'jurusan' => 'required|string',
                'program_studi' => 'required|string',
                'foto_formal' => 'nullable|image|max:2048',
                'upload_ktp' => 'nullable|file|max:2048',
                'upload_ktm' => 'nullable|file|max:2048',
            ]);

            Log::info('Data Pendaftaran:', $validated);

            // Sanitize inputs (trim whitespace)
            $nim = trim($validated['nim_nik']);
            $nama = trim($validated['nama_lengkap']);

            Log::debug('Mencari mahasiswa:', [
                'input_nim' => $nim,
                'input_nama' => $nama,
            ]);

            // Search for student record with case-insensitive match
            $mahasiswa = MahasiswaTerdaftar::where('nim', $nim)
                ->where(function($query) use ($nama) {
                    $query->where('nama_lengkap', 'LIKE', "%$nama%");
                })
                ->first();

            if (!$mahasiswa) {
                $shouldMatch = MahasiswaTerdaftar::where('nim', $nim)
                    ->orWhere('nama_lengkap', 'LIKE', "%$nama%")
                    ->get();

                Log::error('Data tidak ditemukan padahal seharusnya match:', [
                    'should_match' => $shouldMatch,
                    'all_data' => MahasiswaTerdaftar::all()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Mohon maaf, Anda tidak dapat mendaftar untuk tes TOEIC gratis kali ini. Data Anda tidak terdaftar sebagai mahasiswa yang berhak mengikuti tes gratis atau Anda sudah pernah mengikuti tes gratis sebelumnya. Jika Anda ingin mengikuti tes TOEIC, Anda dapat mendaftar secara umum melalui website resmi. Terima kasih atas perhatian Anda.',
                    'errors' => [
                        'nim_nik' => ['NIM tidak valid atau tidak sesuai dengan nama']
                    ]
                ], 422);
            }

            // Handle file uploads
            $data = $validated;

            if ($request->hasFile('foto_formal')) {
                $data['foto_formal'] = $request->file('foto_formal')->store('pendaftar/foto_formal', 'public');
                Log::info('Foto formal disimpan di:', ['path' => $data['foto_formal']]);
            }

            if ($request->hasFile('upload_ktp')) {
                $data['upload_ktp'] = $request->file('upload_ktp')->store('pendaftar/ktp', 'public');
            }

            if ($request->hasFile('upload_ktm')) {
                $data['upload_ktm'] = $request->file('upload_ktm')->store('pendaftar/ktm', 'public');
            }

            // Save the registrant data
            $pendaftar = Pendaftar::create($data);
            Log::info('Pendaftaran berhasil disimpan:', ['id' => $pendaftar->id]);

            return response()->json([
                'success' => true,
                'message' => 'Selamat! Anda berhasil terdaftar untuk mengikuti tes TOEIC gratis. Silakan tunggu informasi lebih lanjut melalui WhatsApp dari pihak TOEIC terkait jadwal dan prosedur tes. Pastikan juga untuk mengecek jadwal tes secara berkala melalui website resmi kami. Terima kasih.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error saat pendaftaran:', [
                'request_data' => $request->all(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }
}

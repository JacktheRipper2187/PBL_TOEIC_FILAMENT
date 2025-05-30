<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use App\Models\MahasiswaTerdaftar;
use App\Models\JadwalPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FormPendaftaranController extends Controller
{
    public function showForm()
    {
        $pendaftars = Pendaftar::all();
        $jadwalList = JadwalPendaftaran::where('kuota', '>', 0)->get();
        return view('formPendaftaran', compact('pendaftars', 'jadwalList'));
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
                'jadwal_pendaftaran_id' => 'required|exists:jadwal_pendaftaran,id',
            ]);

            $nim = trim($validated['nim_nik']);
            $nama = trim($validated['nama_lengkap']);

            $mahasiswa = MahasiswaTerdaftar::where('nim', $nim)
                ->where('nama_lengkap', 'LIKE', "%$nama%")
                ->first();

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mohon maaf, data Anda tidak ditemukan.',
                    'errors' => ['nim_nik' => ['NIM tidak valid atau tidak sesuai dengan nama']]
                ], 422);
            }

            // ⛔ CEK DUPLIKAT GLOBAL NIM
            $duplikatGlobal = Pendaftar::where('nim_nik', $nim)->first();
            if ($duplikatGlobal) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIM ini sudah pernah digunakan untuk pendaftaran.',
                ], 422);
            }

            $jadwal = JadwalPendaftaran::findOrFail($validated['jadwal_pendaftaran_id']);

            // ❗Cek apakah kuota penuh
            if ($jadwal->kuota <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kuota untuk jadwal yang dipilih sudah penuh.',
                    'errors' => ['jadwal_pendaftaran_id' => ['Kuota penuh']]
                ], 422);
            }

            // ❗Cek apakah pendaftaran sudah ditutup atau belum dibuka
            $now = now();
            if (!$jadwal->is_pendaftaran_dibuka) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pendaftaran belum dibuka atau sudah ditutup.',
                ], 422);
            }

            // ❗Cek apakah user sudah mendaftar sebelumnya
            $sudahDaftar = Pendaftar::where('nim_nik', $nim)
                ->where('jadwal_pendaftaran_id', $jadwal->id)
                ->first();

            if ($sudahDaftar) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah terdaftar untuk jadwal ini.',
                ], 422);
            }
                    // Cek kuota pendaftaran
            $jumlahPendaftar = Pendaftar::count();
            $batasPendaftaran = env('KUOTA_PENDAFTARAN_TOEIC', 3000); // atau bisa 3 untuk testing
            
            if ($jumlahPendaftar >= $batasPendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota pendaftaran TOEIC gratis sudah penuh. Terima kasih atas minat Anda.',
            ], 403);
        }

            $data = $validated;

            if ($request->hasFile('foto_formal')) {
                $data['foto_formal'] = $request->file('foto_formal')->store('pendaftar/foto_formal', 'public');
            }

            if ($request->hasFile('upload_ktp')) {
                $data['upload_ktp'] = $request->file('upload_ktp')->store('pendaftar/ktp', 'public');
            }

            if ($request->hasFile('upload_ktm')) {
                $data['upload_ktm'] = $request->file('upload_ktm')->store('pendaftar/ktm', 'public');
            }

            // Simpan pendaftaran
            $pendaftar = Pendaftar::create($data);

            // ❗Kurangi kuota
            $jadwal->decrement('kuota');

            return response()->json([
                'success' => true,
                'message' => 'Selamat! Anda berhasil terdaftar untuk mengikuti tes TOEIC gratis.'
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
         // Cek apakah jumlah pendaftar sudah mencapai batas maksimal
        $jumlahPendaftar = Pendaftar::count();
        $batasPendaftaran = 3000;
        
        if ($jumlahPendaftar >= $batasPendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota pendaftaran TOEIC gratis sudah penuh. Terima kasih atas minat Anda.',
            ], 403);
        }
    }
}
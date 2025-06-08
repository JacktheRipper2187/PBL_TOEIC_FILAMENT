<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\KonfirmasiSk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class KonfirmasiSkMahasiswaController extends Controller
{
    public function create()
    {
        return view('mahasiswa.konfirmasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sertifikat_1' => 'required|file|mimes:pdf',
            'sertifikat_2' => 'required|file|mimes:pdf',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->first();

        $sertifikat_1 = $request->file('sertifikat_1')->store('konfirmasi_sk', 'public');
        $sertifikat_2 = $request->file('sertifikat_2')->store('konfirmasi_sk', 'public');

        KonfirmasiSk::create([
            'mahasiswa_id' => $mahasiswa->id,
            'sertifikat_1' => $sertifikat_1,
            'sertifikat_2' => $sertifikat_2,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan konfirmasi SK berhasil dikirim.');
    }
    public function generateSk($id)
    {
        $konfirmasi = KonfirmasiSk::with('mahasiswa')->findOrFail($id);
        $mahasiswa = $konfirmasi->mahasiswa;

        // Generate PDF
        $pdf = Pdf::loadView('mahasiswa.pengajuan-sk', [
            'nama' => $mahasiswa->nama_lengkap ?? '-',
            'nim' => $mahasiswa->nim ?? '-',
            'prodi' => $mahasiswa->prodi ?? '-',
            'jurusan' => $mahasiswa->jurusan ?? '-',
        ]);

        $filename = 'SK_TOEIC_' . $mahasiswa->nim . '_' . now()->format('YmdHis') . '.pdf';
        $path = 'sk_terbit/' . $filename;

        // Simpan ke storage
        Storage::disk('public')->put($path, $pdf->output());

        // Update DB
        $konfirmasi->update([
            'status' => 'disetujui',
            'file_sk' => $path,
        ]);

        return back()->with('success', 'Surat Keterangan berhasil dibuat.');
    }
}

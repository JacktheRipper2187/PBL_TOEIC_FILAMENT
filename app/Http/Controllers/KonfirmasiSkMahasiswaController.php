<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\KonfirmasiSk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KonfirmasiSkMahasiswaController extends Controller
{
    public function create()
    {
        return view('mahasiswa.konfirmasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sertifikat_1' => 'required|file|mimes:pdf|max:2048', // 2MB
            'sertifikat_2' => 'required|file|mimes:pdf|max:2048',
        ], [
            'sertifikat_1.max' => 'Sertifikat 1 tidak boleh lebih dari 2MB',
            'sertifikat_2.max' => 'Sertifikat 2 tidak boleh lebih dari 2MB',
            'sertifikat_1.mimes' => 'Sertifikat 1 harus berupa PDF',
            'sertifikat_2.mimes' => 'Sertifikat 2 harus berupa PDF',
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

    // Data dasar
    $nomorSurat = 'SK/' . $konfirmasi->id . '/PL2.UPA-BHS/' . date('Y');
    $tanggal = now()->isoFormat('D MMMM Y');

    // QR Code
    $verificationUrl = route('sk.verify', ['id' => $konfirmasi->id]);
    $qrCode = 'data:image/png;base64,' . base64_encode(
        QrCode::format('png')
            ->size(100)
            ->errorCorrection('H')
            ->generate($verificationUrl)
    );

    // Logo dan Tanda Tangan
    $logo = 'data:image/png;base64,' . base64_encode(
        file_get_contents(public_path('assets/img/Logo Polinema.png'))
    );

    $signaturePath = storage_path('app/public/signatures/ttd_atiqah.png');
    $signature = file_exists($signaturePath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath))
        : null;

    // Data untuk PDF
    $data = [
        'nomorSurat' => $nomorSurat,
        'nama' => $mahasiswa->nama_lengkap ?? '-',
        'nim' => $mahasiswa->nim ?? '-',
        'prodi' => $mahasiswa->prodi ?? '-',
        'jurusan' => $mahasiswa->jurusan ?? '-',
        'tanggal' => $tanggal,
        'logoPath' => $logo,
        'signature' => $signature,
        'qrCode' => $qrCode,
        'verificationUrl' => $verificationUrl,
    ];

    // Generate PDF
    $pdf = Pdf::loadView('mahasiswa.pengajuan-sk', $data)
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial',
            'isPhpEnabled' => true
        ])
        ->setPaper('A4', 'portrait');

    // Simpan PDF ke storage
    $filename = 'SK_TOEIC_' . $mahasiswa->nim . '_' . now()->format('YmdHis') . '.pdf';
    $path = 'sk_terbit/' . $filename;
    Storage::disk('public')->put($path, $pdf->output());

    // Update status
    $konfirmasi->update([
        'status' => 'disetujui',
        'file_sk' => $path,
    ]);

    return back()->with('success', 'Surat Keterangan berhasil dibuat.');
}

}

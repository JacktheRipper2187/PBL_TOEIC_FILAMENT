<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hasil;
use Illuminate\Support\Facades\Storage;

class HasilController extends Controller
{
    public function cari(Request $request)
    {
        $request->validate([
            'sesi' => 'required',
        ]);

        $hasil = Hasil::where('sesi', 'like', "%{$request->sesi}%")->first();

        if (!$hasil) {
            return back()->with('error', 'Hasil tidak ditemukan.');
        }

        return view('hasil', compact('hasil'));
    }

    // Fungsi untuk download file hasil ujian
    public function download($id)
    {
        $hasil = Hasil::findOrFail($id);
        $path = $hasil->file_path; // langsung pakai file_path apa adanya

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            abort(404, "File tidak ditemukan.");
        }

        return $disk->download($path, basename($path));
    }


}

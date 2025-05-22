<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class TemplateController extends Controller
{
    public function mahasiswaTerdaftar()
    {
        $file = storage_path('app/templates/template_mahasiswa_terdaftar.xlsx');

        // Pastikan file ada
        if (!file_exists($file)) {
            abort(404, 'File tidak ditemukan');
        }

        // Bersihkan output buffer sebelum mengirim file
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        return response()->download($file, 'template_mahasiswa_terdaftar.xlsx');
    }
}

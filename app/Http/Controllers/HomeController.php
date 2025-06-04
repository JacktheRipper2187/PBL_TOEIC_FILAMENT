<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class HomeController extends Controller
{
    public function index()
    {
        $beranda = Pendaftaran::first(); // atau bisa sesuaikan query-nya
        $section = [
            'Beranda' => $beranda
        ];

        $pendaftaranAktif = is_pendaftaran_active(); // ⬅ Tambahkan ini

        return view('Depan', compact('section', 'pendaftaranAktif')); // ⬅ dan kirim ke Blade
    }
}

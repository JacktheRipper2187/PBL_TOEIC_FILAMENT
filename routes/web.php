<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HasilDepanController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Menampilkan form pendaftaran (GET)
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

// Menyimpan data pendaftaran (POST)
Route::post('/pendaftaran/store', [PesertaController::class, 'store'])
     ->name('pendaftaran.store');

// Menampilkan daftar peserta (GET)
Route::get('/peserta', [PesertaController::class, 'index'])
     ->name('peserta.index');

// GANTI route ini:
// Route::get('/', function () {
//     return view('Depan');
// });

// DENGAN ini (pakai controller)
Route::get('/', [JadwalController::class, 'index']);

// Ganti bahasa
Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change.language');

//hasil
// Route::get('/hasilini', [HasilDepanController::class, 'index'])->name('hasil.index');          // halaman form cari sesi
Route::get('/hasil/cari', [HasilController::class, 'cari'])->name('hasil.cari');       // proses pencarian hasil
Route::get('/hasil/download/{id}', [HasilController::class, 'download'])->name('hasil.download'); // download file hasil
// Route::get('/hasil', [HasilDepanController::class, 'index'])->name('hasil.index');
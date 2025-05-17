<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;

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
    return view('pendaftaran'); // resources/views/pendaftaran.blade.php
})->name('pendaftaran');

// Menyimpan data pendaftaran (POST)
Route::post('/pendaftaran/store', [PesertaController::class, 'store'])
     ->name('pendaftaran.store');

// Menampilkan daftar peserta (GET)
Route::get('/peserta', [PesertaController::class, 'index'])
     ->name('peserta.index');
Route::get('/', function () {
    return view('Depan');
});
// Menampilkan form pendaftaran (GET)
Route::get('/pendaftaran', function () {
    return view('pendaftaran'); // resources/views/pendaftaran.blade.php
})->name('pendaftaran');
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\FormPendaftaranController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HasilDepanController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\JadwalPendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Models\JadwalPendaftaran;
use App\Http\Controllers\Auth\LoginController;



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




// DENGAN ini (pakai controller)    
// Route::get('/', [JadwalController::class, 'index']);

Route::get('/', function () {
    $JadwalPendaftaran = JadwalPendaftaran::all(); // atau query sesuai kebutuhan
    // variabel lain juga bisa dikirim di sini
    return view('guest', compact('JadwalPendaftaran'));
});

Route::get('/mahasiswa/depan', [JadwalController::class, 'index'])->name('mahasiswa.depan');

// Ganti bahasa
Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change.language');

// Route untuk form pendaftaran
Route::get('/formpendaftaran', [FormPendaftaranController::class, 'showForm'])->name('pendaftaran.form');

// Route untuk menyimpan data pendaftaran
Route::post('/formpendaftaran', [FormPendaftaranController::class, 'submitForm'])->name('pendaftaran.store');

// Route untuk validasi NIM
Route::post('/formpendaftaran/check-nim', [FormPendaftaranController::class, 'checkNim'])->name('pendaftaran.checkNim');

//hasil
// Route::get('/hasilini', [HasilDepanController::class, 'index'])->name('hasil.index');          // halaman form cari sesi
Route::get('/hasil/cari', [HasilController::class, 'cari'])->name('hasil.cari');      
Route::get('/hasil/download/{id}', [HasilController::class, 'download'])->name('hasil.download'); // download file hasil
// Route::get('/hasil', [HasilDepanController::class, 'index'])->name('hasil.index');

// Route untuk download template Excel MahasiswaTerdaftar
Route::get('/template/mahasiswa-terdaftar', [TemplateController::class, 'mahasiswaTerdaftar'])->name('template.mahasiswa-terdaftar');

// Route untuk export data pendaftars
Route::get('/admin/pendaftar/export-excel', [PendaftarController::class, 'exportExcel'])->name('admin.pendaftar.export-excel');
Route::get('/admin/pendaftar/export-pdf', [PendaftarController::class, 'exportPdf'])->name('admin.pendaftar.export-pdf');

// Halaman depan
// Route::get('/', [JadwalController::class, 'index']);

// Admin: CRUD Jadwal Pendaftaran
Route::prefix('admin/jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'adminIndex'])->name('admin.jadwal.index');
    Route::get('/create', [JadwalController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/store', [JadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::get('/edit/{id}', [JadwalController::class, 'edit'])->name('admin.jadwal.edit');
    Route::put('/update/{id}', [JadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/delete/{id}', [JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');
});

Route::get('/login', function () {
    return view('login');
})->middleware(['auth', 'verified'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// routes/web.php

Route::middleware(['auth'])->group(function () {
    // Jika mahasiswa sudah login, tetap bisa akses halaman depan
    Route::get('/beranda', function () {
        return view('mahasiswa.depan');
    })->name('mahasiswa.depan');
});


require __DIR__.'/auth.php';
// routes/web.php

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [JadwalController::class, 'index'])->name('mahasiswa.depan');
});
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $kampusOptions = [
            'utama' => 'Kampus Utama',
            'kediri' => 'Kampus Kediri',
            'lumajang' => 'Kampus Lumajang',
            'pamekasan' => 'Kampus Pamekasan'
        ];

        return view('auth.register', compact('kampusOptions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validKampus = ['utama', 'kediri', 'lumajang', 'pamekasan'];
        $validJurusan = [
            "utama" => ["TE", "TM", "TS", "AK", "AN", "TK", "TI"],
            "kediri" => ["TI", "TM", "AK", "TE"],
            "lumajang" => ["TI", "TS", "AK"],
            "pamekasan" => ["TM", "AK", "AN"]
        ];
        $validProdi = [
            "TE" => ["D-IV Teknik Elektronika", "D-IV Sistem Kelistrikan", "D-IV Jaringan Telekomunikasi Digital", "D-III Teknik Elektronika", "D-III Teknik Listrik", "D-III Teknik Telekomunikation"],
            "TM" => ["D-IV Teknik Otomotif Elektronik", "D-IV Teknik Mesin Produksi dan Perawatan", "D-III Teknik Mesin", "D-III Teknologi Pemeliharaan Pesawat Udara"],
            "TS" => ["D-IV Manajemen Rekayasa Konstruksi", "D-IV Teknologi Rekayasa Konstruksi Jalan dan Jembatan", "D-III Teknik Sipil", "D-III Teknik Konstruksi Jalan dan Jembatan", "D-III Teknologi Pertambangan"],
            "AK" => ["D-IV Akuntansi Manajemen", "D-IV Keuangan", "D-III Akuntansi"],
            "AN" => ["D-IV Manajemen Pemasaran", "D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional", "D-IV Pengelolaan Arsip dan Rekaman Informasi", "D-IV Usaha Perjalanan Wisata", "D-IV Bahasa Inggris untuk Industri Pariwisata", "D-III Administrasi Bisnis"],
            "TK" => ["D-IV Teknologi Kimia Industri", "D-III Teknik Kimia"],
            "TI" => ["D-IV Teknik Informatika", "D-IV Sistem Informasi Bisnis", "D-II Pengembangan Piranti Lunak Situs"]
        ];

        $request->validate([
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswas'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email','unique:mahasiswas,email'],
            'no_telp' => ['required', 'string', 'max:15'],
            'kampus' => ['required', 'string', 'in:' . implode(',', $validKampus)],
            'jurusan' => ['required', 'string', function ($attribute, $value, $fail) use ($request, $validJurusan) {
                if (!in_array($value, $validJurusan[$request->kampus] ?? [])) {
                    $fail('Jurusan yang dipilih tidak valid untuk kampus ini.');
                }
            }],
            'prodi' => ['required', 'string', function ($attribute, $value, $fail) use ($request, $validProdi) {
                if (!in_array($value, $validProdi[$request->jurusan] ?? [])) {
                    $fail('Program studi yang dipilih tidak valid untuk jurusan ini.');
                }
            }],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'kampus' => $request->kampus,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi
        ]);

        // Assign role
        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa']);
        $user->assignRole($mahasiswaRole);

        event(new Registered($user));

        return redirect()->route('login')->with([
            'status' => 'success',
            'message' => 'Registrasi berhasil! Silakan login'
        ]);
    }
}

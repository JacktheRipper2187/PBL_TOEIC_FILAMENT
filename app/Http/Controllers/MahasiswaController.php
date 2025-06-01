<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // Ubah menjadi profil() untuk konsistensi dengan route
    public function profil()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa; // Ambil dari relasi

        $site_name = config('app.name');
        $section = 'profile';

        return view('mahasiswa.profile', compact('mahasiswa', 'user', 'site_name', 'section'));
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('password_success', 'Password berhasil diubah.');
    }


    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Hapus foto lama jika ada
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('foto_mahasiswa', 'public');

        $mahasiswa->foto = $path;
        $mahasiswa->save();

        return back()->with('foto_success', 'Foto profil berhasil diperbarui.');
    }
}

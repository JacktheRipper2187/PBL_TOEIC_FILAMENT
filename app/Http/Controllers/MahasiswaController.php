<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\KonfirmasiSk;

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
    //public function updatePengambilan(Request $request, $id)
//{
    // Ambil mahasiswa berdasarkan id
    //$mahasiswa = Mahasiswa::findOrFail($id);

    // Validasi input gambar jika ada
    //$request->validate([
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Aturan validasi gambar
    //]);

    // Jika ada gambar yang diupload
    //if ($request->hasFile('image')) {
        // Simpan gambar ke storage/public dan ambil pathnya
        //$imagePath = $request->file('image')->store('images/sertifikat', 'public');
        
        // Simpan path gambar ke kolom yang sesuai (misalnya `image_path`)
        //$mahasiswa->image_path = $imagePath;
    //}

    // Perbarui status pengambilan sertifikat menjadi 'sudah'
    //$mahasiswa->pengambilan_sertifikat = 'sudah';
    //$mahasiswa->save();

    // Redirect kembali dengan pesan sukses
    //return redirect()->back()->with('success', 'Status pengambilan sertifikat berhasil diperbarui.');
//}

public function updateStatus($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->pengambilan_sertifikat = 'sudah'; // Update status to 'sudah'
    $mahasiswa->save();

    return redirect()->back()->with('success', 'Status updated to Sudah!');
}

    public function downloadSk($id)
{
    $konfirmasi = KonfirmasiSk::findOrFail($id);

    // Path ke file-nya
    $path = storage_path('app/public/' . $konfirmasi->file_sk);

    if (!file_exists($path)) {
        abort(404);
    }

    // Beri nama file saat diunduh (opsional)
    $filename = 'SK_TOEIC_' . $konfirmasi->mahasiswa->nama . '.pdf';

    return response()->download($path, $filename);
}

}

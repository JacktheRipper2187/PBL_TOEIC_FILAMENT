<?php

use App\Models\JadwalPendaftaran;
use App\Models\JadwalSertifikat;
use App\Models\section;
use App\Models\setting;
use App\Models\pendaftaran;
use App\Models\JadwalUjian;
use Illuminate\Support\Facades\DB;



function get_setting_value($key)
{
    $locale = session('locale', 'id'); // Default ke 'id'
    $setting = DB::table('settings')->where('key', $key)->first();

    if ($setting) {
        // Ambil value sesuai bahasa
        return $locale === 'en' ? $setting->value_en : $setting->value_id;
    }

    return null; // Jika setting tidak ditemukan
}

function get_section_value()
{
    $locale = session('locale', 'id'); // Default ke 'id'
    $data = section::where('locale', $locale)
        ->whereIn('post_as', ['Beranda', 'SyaratKetentuan'])
        ->get(['post_as', 'title', 'thumbnail', 'content']);

    if ($data->isNotEmpty()) {
        return $data->keyBy('post_as'); // Biar bisa diakses seperti array: $data['Beranda']
    } else {
        return collect(); // Koleksi kosong, lebih aman daripada string 'empty'
    }
}
function get_pendaftaran_value() {
    $locale = session('locale', 'id'); // atau app()->getLocale()
    return DB::table('pendaftarans')->where('locale', $locale)->get();
}
function get_JadwalPendaftaran_value()
{
  $data = JadwalPendaftaran::all();
  return $data;
}
function get_JadwalSertifikat_value()
{
  $data = JadwalSertifikat::all();
  return $data;
}
function get_JadwalUjian_value()
{
  $data = JadwalUjian::all();
  return $data;
}
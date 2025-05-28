
<?php

use App\Models\JadwalPendaftaran;
use App\Models\JadwalSertifikat;
use App\Models\Section;
use App\Models\Setting;
use App\Models\pendaftaran;
use App\Models\JadwalUjian;
use Illuminate\Support\Facades\DB;

if (!function_exists('get_setting_value')) {
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
}

if (!function_exists('get_section_value')) {
    function get_section_value()
    {
        $locale = session('locale', 'id'); // Default ke 'id'
        $data = Section::where('locale', $locale)
            ->whereIn('post_as', ['Beranda', 'SyaratKetentuan'])
            ->get(['post_as', 'title', 'thumbnail', 'content']);

        if ($data->isNotEmpty()) {
            return $data->keyBy('post_as'); // Biar bisa diakses seperti array: $data['Beranda']
        } else {
            return collect(); // Koleksi kosong, lebih aman daripada string 'empty'
        }
    }
}

if (!function_exists('get_pendaftaran_value')) {
    function get_pendaftaran_value() {
        $locale = session('locale', 'id'); // atau app()->getLocale()
        return DB::table('pendaftarans')->where('locale', $locale)->get();
    }
}

if (!function_exists('get_JadwalPendaftaran_value')) {
    function get_JadwalPendaftaran_value()
    {
        $data = JadwalPendaftaran::all();
        return $data;
    }
}

if (!function_exists('get_JadwalSertifikat_value')) {
    function get_JadwalSertifikat_value()
    {
        $data = JadwalSertifikat::all();
        return $data;
    }
}

if (!function_exists('get_JadwalUjian_value')) {
    function get_JadwalUjian_value()
    {
        $data = JadwalUjian::all();
        return $data;
    }
}

function get_JadwalUjian_value()
{
  $data = JadwalUjian::all();
  return $data;
}


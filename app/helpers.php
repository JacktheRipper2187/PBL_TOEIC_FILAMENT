<?php

use App\Models\JadwalPendaftaran;
use App\Models\JadwalSertifikat;
use App\Models\section;
use App\Models\setting;
use App\Models\pendaftaran;
use App\Models\JadwalUjian;



function get_setting_value($key)
{
  $data = setting::where('key', $key)->first();
  if (isset($data->value)) {
    return $data->value;
  } else {
    return 'empty';
  }
}

function get_section_value()
{
  $data = section::whereIn('post_as', ['Beranda', 'SyaratKetentuan'])
    ->get(['post_as', 'title', 'thumbnail', 'content']);

  if ($data->isNotEmpty()) {
    return $data->keyBy('post_as'); // Biar bisa diakses seperti array: $data['Beranda']
  } else {
    return collect(); // koleksi kosong, lebih aman daripada string 'empty'
  }
}
function get_pendaftaran_value()
{
  $data = pendaftaran::all();
  return $data;
}
function get_JadwalPendafatran_value()
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
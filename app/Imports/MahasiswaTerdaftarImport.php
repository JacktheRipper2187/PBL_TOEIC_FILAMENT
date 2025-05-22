<?php

namespace App\Imports;

use App\Models\MahasiswaTerdaftar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaTerdaftarImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new MahasiswaTerdaftar([
            'nama_lengkap'    => $row['nama_lengkap'],
            'nim'             => $row['nim'],
            'no_hp'           => $row['no_hp'],
            'email'           => $row['email'],
            'alamat_asal'     => $row['alamat_asal'],
            'kampus'          => $row['kampus'],
            'jurusan'         => $row['jurusan'],
            'program_studi'   => $row['program_studi'],
        ]);
    }
}

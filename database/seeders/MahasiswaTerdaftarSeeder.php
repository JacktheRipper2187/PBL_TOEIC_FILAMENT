<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MahasiswaTerdaftar;

class MahasiswaTerdaftarSeeder extends Seeder
{
    public function run(): void
    {
        MahasiswaTerdaftar::create([
            'nama_lengkap' => 'Nazwa Nurul Wijaya',
            'nim' => '2341760045',
            'no_hp' => '081234567891',
            'email' => 'nazwa@gmail.com',
            'alamat_asal' => 'Pasuruan',
            'kampus' => 'Kampus Utama',
            'jurusan' => 'Teknologi Informasi',
            'program_studi' => 'D-IV Sistem Informasi Bisnis',
        ]);

        MahasiswaTerdaftar::create([
            'nama_lengkap' => 'Rafi Ahmad Pratama',
            'nim' => '2141720002',
            'no_hp' => '082345678912',
            'email' => 'rafi@gmail.com',
            'alamat_asal' => 'Malang',
            'kampus' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknologi Informasi',
            'program_studi' => 'D-IV Teknik Informatika',
        ]);

        MahasiswaTerdaftar::create([
            'nama_lengkap' => 'Indah Lestari Putri',
            'nim' => '2141720003',
            'no_hp' => '083456789123',
            'email' => 'indah@gmail.com',
            'alamat_asal' => 'Blitar',
            'kampus' => 'Politeknik Negeri Malang',
            'jurusan' => 'Akuntansi',
            'program_studi' => 'D3 Akuntansi',
        ]);
    }
}

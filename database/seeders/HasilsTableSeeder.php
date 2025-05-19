<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('hasils')->insert([
            [
                'sesi' => 'Sesi 3',
                'tanggal_ujian' => '2025-05-19',
                'file_path' => 'hasil/Pandangan Pakar UMY Terkait Putusan MK Soal ....pdf',
                'keterangan' => null,
                'created_at' => '2025-05-19 08:17:52',
                'updated_at' => '2025-05-19 08:17:52',
            ],
            [
                'sesi' => 'Sesi 4',
                'tanggal_ujian' => '2025-05-03',
                'file_path' => 'hasil/RekapNilaiMID-D4SIB-2F.pdf',
                'keterangan' => null,
                'created_at' => '2025-05-19 08:57:16',
                'updated_at' => '2025-05-19 08:57:16',
            ],
            [
                'sesi' => 'Sesi 2',
                'tanggal_ujian' => '2025-05-10',
                'file_path' => 'hasil/nilai.pdf',
                'keterangan' => null,
                'created_at' => '2025-05-19 09:01:24',
                'updated_at' => '2025-05-19 09:01:24',
            ],
            [
                'sesi' => 'Sesi 4',
                'tanggal_ujian' => '2025-05-24',
                'file_path' => 'hasil/Proklamasi Negara Melanesia Barat 14 Desember....pdf',
                'keterangan' => null,
                'created_at' => '2025-05-19 10:08:47',
                'updated_at' => '2025-05-19 10:08:47',
            ],
        ]);
    }
}
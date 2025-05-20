<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPendaftaranTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwal_pendaftaran')->insert([
            [
                'lokasi' => 'POLITEKNIK NEGRI MALANG',
                'tgl_buka' => '2025-05-19',
                'tgl_tutup' => '2025-05-24',
                'kuota' => 300,
                'created_at' => '2025-05-19 13:45:43',
                'updated_at' => null,
            ],
        ]);
    }
}
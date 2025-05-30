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
                'skema' => 'gratis',
                'tgl_buka' => '2025-05-19',
                'tgl_tutup' => '2025-05-24',
                'kuota' => 300,
                'kuota_asli' => 300,
                'keterangan' => 'Online',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
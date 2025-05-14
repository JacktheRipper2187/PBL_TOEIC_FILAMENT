<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pendaftarans')->insert([
            [
                'title' => 'PENDAFTARAN BERBAYAR',
                'thumbnail' => '01JV03NT3PC36AANR375W2X0SZ.png',
                'content' => '<p>Pokoknya ini bayar kalau daftar di sini harus bayar</p>',
                'link' => 'https://itc-indonesia.com/toeic/',
            ],
            [
                'title' => 'PENDAFTARAN GRATIS',
                'thumbnail' => '01JV03M9YV2MG5BG0GXAN9ZS3V.png',
                'content' => '<p>Ini gratis</p>',
                'link' => '-',
            ],
        ]);
    }
}

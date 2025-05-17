<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendaftarans')->insert([
            [
                'title_id' => 'PENDAFTARAN BERBAYAR',
                'title_en' => 'PAID REGISTRATION',
                'thumbnail_id' => '01Jv08SWA1GJFEJJGGTNXDPRP.png', // Thumbnail untuk bahasa Indonesia
                'thumbnail_en' => '01Jv08SWA1GJFEJJGGTNXDPRP_EN.png', // Thumbnail untuk bahasa Inggris
                'content_id' => '<p>Pokoknya ini bayar kalau daftar di sini harus bayar.</p>',
                'content_en' => '<p>You need to pay if you register here.</p>',
                'link' => 'https://ltc-indonesia.com/toeic/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_id' => 'PENDAFTARAN GRATIS',
                'title_en' => 'FREE REGISTRATION',
                'thumbnail_id' => '01Jv08R42PQVK5NORJQ8ZR5JZ.png', // Thumbnail untuk bahasa Indonesia
                'thumbnail_en' => '01Jv08R42PQVK5NORJQ8ZR5JZ_EN.png', // Thumbnail untuk bahasa Inggris
                'content_id' => '<p>Ini gratis.</p>',
                'content_en' => '<p>This is free.</p>',
                'link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
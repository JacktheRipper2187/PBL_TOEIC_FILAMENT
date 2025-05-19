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
                'group_id'   => 1,
                'locale'     => 'id',
                'title'      => 'PENDAFTARAN BERBAYAR',
                'thumbnail'  => '01JV69SWA1GJFEJJGGTNXDPRP.png',
                'content'    => '<p>Pokoknya ini bayar kalau daftar di sini harus bayar.</p>',
                'link'       => 'https://ltc-indonesia.com/toeic/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 2,
                'locale'     => 'id',
                'title'      => 'PENDAFTARAN GRATIS',
                'thumbnail'  => '01JV69R42PQVK5NORJQ8ZR5JZ.png',
                'content'    => '<p>ini gratis&nbsp;</p>',
                'link'       => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 1,
                'locale'     => 'en',
                'title'      => 'PAID REGISTRATION',
                'thumbnail'  => '01JVBNEJQKFXPT25YVEKN5768.png',
                'content'    => '<p>This is paid registration...</p>',
                'link'       => 'https://ltc-indonesia.com/toeic/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 2,
                'locale'     => 'en',
                'title'      => 'FREE REGISTRATION',
                'thumbnail'  => '01JVB3Y229QCZJZ3673CEE200.png',
                'content'    => '<p>This is free registration...</p>',
                'link'       => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
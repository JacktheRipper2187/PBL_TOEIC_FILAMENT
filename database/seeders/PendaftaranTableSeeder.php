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
                'thumbnail'  => '01JVKR1DHWGE462E0N9QMZYPFE.png',
                'content'    => '<p>Pokoknya ini bayar kalau daftar di sini harus bayar.</p>',
                'link'       => 'https://itc-indonesia.com/toeic/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 2,
                'locale'     => 'id',
                'title'      => 'PENDAFTARAN GRATIS',
                'thumbnail'  => '01JVKRB4KSQFNS9XVR7SRSF0WB.png',
                'content'    => '<p>ini gratis&nbsp;</p>',
                'link'       => 'formpendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 1,
                'locale'     => 'en',
                'title'      => 'PAID REGISTRATION',
                'thumbnail'  => '01JVKRJ9WGPZBC9CY1SYN81ZZ8.png',
                'content'    => '<p>This is paid registration...</p>',
                'link'       => 'https://itc-indonesia.com/toeic/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id'   => 2,
                'locale'     => 'en',
                'title'      => 'FREE REGISTRATION',
                'thumbnail'  => '01JVKRKE7V19P7WKPFA7T877T3.png',
                'content'    => '<p>This is free registration...</p>',
                'link'       => 'formpendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
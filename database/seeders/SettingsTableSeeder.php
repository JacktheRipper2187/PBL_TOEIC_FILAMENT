<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => '_site_name',
                'label' => 'Judul Situs',
                'value_id' => 'UPA Bahasa Polinema',
                'value_en' => 'UPA Bahasa Polinema',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => '_location',
                'label' => 'Alamat Kantor',
                'value_id' => 'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur 65141',
                'value_en' => 'Jl. Soekarno Hatta No. 9, Malang, East Java 65141',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => '_instagram',
                'label' => 'Instagram',
                'value_id' => 'https://www.instagram.com/upabahasa/',
                'value_en' => 'https://www.instagram.com/upabahasa/',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => '_whatsapp',
                'label' => 'Whatsapp',
                'value_id' => 'https://wa.me/6281234567890',
                'value_en' => 'https://wa.me/6281234567890',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => '_email',
                'label' => 'Email',
                'value_id' => 'upabahasapolinema@gmail.com',
                'value_en' => 'upabahasapolinema@gmail.com',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => '_site_description',
                'label' => 'Deskripsi Situs',
                'value_id' => 'Jika Butuh Bantuan Silahkan Hubungi Kami',
                'value_en' => 'If You Need Help, Please Contact Us',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'title' => 'Selamat Datang di Website',
                'thumbnail' => 'UPA BAHASA POLINEMA',
                'content' => '<p>Unit Pelaksana Akademik Bahasa di Politeknik Negeri Malang adalah unit yang bertanggung jawab atas penyelenggaraan layanan bahasa, termasuk pelaksanaan ujian sertifikasi bahasa seperti TOEIC (Test of English for International Communication).</p>',
                'post_as' => 'Beranda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Syarat dan Ketentuan',
                'thumbnail' => 'Syarat dan Ketentuan',
                'content' => '<h2><strong>Persyaratan Peserta:</strong></h2><ol><li>Peserta harus membawa katu identitas</li><li>Peserta harus hadir 30 menit sebelum ujian</li><li>Peserta harus membawa alat tulis</li></ol><h2><strong>Ketentuan Pendaftaran</strong></h2><ol><li>Isi formulir pendaftaran online</li><li>Unggah dokumen yang&nbsp; diperlukan</li><li>Konfirmasi pembayaran (jika berbayar)</li></ol><h2><strong>Ketentuan Pelaksanaan Ujian:</strong></h2><ol><li>Peserta harus mengikuti intruksi pengawas</li><li>Tidak diperbolehkan membawa perangkat elektronik</li><li>Peserta harus menjaga ketertiban selama ujian</li></ol>',
                'post_as' => 'SyaratKetentuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

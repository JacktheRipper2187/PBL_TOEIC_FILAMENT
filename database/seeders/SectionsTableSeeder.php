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
            // Data untuk bahasa Indonesia
            [
                'title' => 'Selamat Datang di Website',
                'thumbnail' => 'UPA BAHASA POLINEMA',
                'content' => '<p>Unit Pelaksana Akademik Bahasa di Politeknik Negeri Malang adalah unit yang bertanggung jawab atas penyelenggaraan layanan bahasa, termasuk pelaksanaan ujian sertifikasi bahasa seperti TOEIC (Test of English for International Communication).</p>',
                'post_as' => 'Beranda',
                'locale' => 'id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Syarat dan Ketentuan',
                'thumbnail' => 'Syarat dan Ketentuan',
                'content' => '<h2><strong>Persyaratan Peserta:</strong></h2><ol><li>Peserta harus membawa kartu identitas</li><li>Peserta harus hadir 30 menit sebelum ujian</li><li>Peserta harus membawa alat tulis</li></ol><h2><strong>Ketentuan Pendaftaran</strong></h2><ol><li>Isi formulir pendaftaran online</li><li>Unggah dokumen yang diperlukan</li><li>Konfirmasi pembayaran (jika berbayar)</li></ol><h2><strong>Ketentuan Pelaksanaan Ujian:</strong></h2><ol><li>Peserta harus mengikuti instruksi pengawas</li><li>Tidak diperbolehkan membawa perangkat elektronik</li><li>Peserta harus menjaga ketertiban selama ujian</li></ol>',
                'post_as' => 'SyaratKetentuan',
                'locale' => 'id',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Data untuk bahasa Inggris
            [
                'title' => 'Welcome to the Website',
                'thumbnail' => 'UPA BAHASA POLINEMA',
                'content' => '<p>The Language Academic Unit at Politeknik Negeri Malang is responsible for providing language services, including conducting language certification exams such as TOEIC (Test of English for International Communication).</p>',
                'post_as' => 'Beranda',
                'locale' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Terms and Conditions',
                'thumbnail' => 'Terms and Conditions',
                'content' => '<h2><strong>Participant Requirements:</strong></h2><ol><li>Participants must bring their ID card</li><li>Participants must arrive 30 minutes before the exam</li><li>Participants must bring writing tools</li></ol><h2><strong>Registration Terms:</strong></h2><ol><li>Fill out the online registration form</li><li>Upload the required documents</li><li>Confirm payment (if applicable)</li></ol><h2><strong>Exam Rules:</strong></h2><ol><li>Participants must follow the supervisor\'s instructions</li><li>Electronic devices are not allowed</li><li>Participants must maintain order during the exam</li></ol>',
                'post_as' => 'SyaratKetentuan',
                'locale' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
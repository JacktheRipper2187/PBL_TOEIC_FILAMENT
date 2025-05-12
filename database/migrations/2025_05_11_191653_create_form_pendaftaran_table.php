<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_pendaftaran', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('email');
            $table->string('no_hp');
            $table->text('alamat_asal');
            $table->text('alamat_sekarang');
            
            // Data Akademik
            $table->string('kampus');
            $table->string('jurusan');
            $table->string('prodi');
            
            // Upload Berkas
            $table->string('pas_foto_path');
            $table->string('ktp_path');
            $table->string('ktm_path');
            
            // Status Verifikasi
            $table->boolean('is_verified')->default(false);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_pendaftaran');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('pendaftars', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nim_nik')->unique();
        $table->string('email');
        $table->string('alamat_asal');
        $table->string('alamat_sekarang');
        $table->string('kampus');
        $table->string('jurusan');
        $table->string('program_studi');
        $table->string('foto_formal')->nullable();
        $table->string('upload_ktp')->nullable();
        $table->string('upload_ktm')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};

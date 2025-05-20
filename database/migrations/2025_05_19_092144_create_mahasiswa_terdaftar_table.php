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
    Schema::create('mahasiswa_terdaftar', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nim')->unique();
        $table->string('no_hp');
        $table->string('email');
        $table->string('alamat_asal');
        $table->string('kampus');
        $table->string('jurusan');  
        $table->string('program_studi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_terdaftar');
    }
};

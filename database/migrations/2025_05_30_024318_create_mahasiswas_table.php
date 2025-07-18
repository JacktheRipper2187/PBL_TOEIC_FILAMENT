<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('no_telp');
            $table->string('kampus');
            $table->string('jurusan');
            $table->string('prodi');
            $table->string('email'); // Hapus nullable dan duplikasi
            //$table->string('image_path')->nullable();
            $table->string('pengambilan_sertifikat')->default('belum'); // Hapus nullable dan duplikasi
            $table->string('foto')->nullable();
            $table->timestamps();

            // Tambahkan indeks untuk performa
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};

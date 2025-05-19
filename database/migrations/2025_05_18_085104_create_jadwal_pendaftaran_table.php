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
        // contoh untuk jadwal_pendaftaran
Schema::create('jadwal_pendaftarans', function (Blueprint $table) {
    $table->id();
    $table->string('lokasi');
    $table->date('tgl_buka');
    $table->date('tgl_tutup');
    $table->integer('kuota');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pendaftaran');
    }
};

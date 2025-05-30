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
      Schema::create('jadwal_sertifikat', function (Blueprint $table) {
        $table->id();
        $table->time('waktu');
        $table->string('lokasi');
        $table->date('hari_tanggal');
        $table->text('keterangan');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sertifikat');
    }
};

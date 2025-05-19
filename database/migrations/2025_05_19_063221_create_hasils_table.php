<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->string('sesi');
            $table->date('tanggal_ujian');
            $table->string('file_path'); // path ke file hasil
            $table->string('keterangan')->nullable(); // optional, jika mau pakai keterangan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasils');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPendaftaranTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jadwal')->nullable(); // Nama jadwal pendaftaran, opsional
            $table->string('skema');                    // Tambahan: nama skema pendaftaran
            $table->date('tgl_buka');                   // tanggal mulai pendaftaran
            $table->date('tgl_tutup');                  // tanggal berakhir pendaftaran
            $table->integer('kuota');                   // kuota peserta
            $table->integer('kuota_asli');                   // kuota peserta asli
            $table->text('keterangan')->nullable();     // keterangan tambahan, opsional
            $table->timestamps();                       // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_pendaftaran');
    }
}

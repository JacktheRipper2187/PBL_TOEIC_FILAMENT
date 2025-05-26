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
            $table->string('lokasi');          // varchar(255), NOT NULL
            $table->date('tgl_buka');          // date, NOT NULL
            $table->date('tgl_tutup');         // date, NOT NULL
            $table->integer('kuota');          // int, NOT NULL
            $table->timestamps();              // created_at & updated_at nullable timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_pendaftaran');
    }
}

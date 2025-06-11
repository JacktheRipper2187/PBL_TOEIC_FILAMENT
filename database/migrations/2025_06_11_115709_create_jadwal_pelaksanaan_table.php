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
        Schema::create('jadwal_pelaksanaan', function (Blueprint $table) {
            $table->id();
            // Menambahkan kolom 'jadwal_pendaftaran_id' terlebih dahulu
            $table->unsignedBigInteger('jadwal_pendaftaran_id');  
            // Kemudian menambahkan foreign key
            $table->foreign('jadwal_pendaftaran_id')->references('id')->on('jadwal_pendaftaran')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('sesi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('lokasi_platform');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelaksanaan');
    }
};

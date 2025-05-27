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
        Schema::table('pendaftars', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->unsignedBigInteger('jadwal_pendaftaran_id')->nullable()->after('program_studi');
            $table->foreign('jadwal_pendaftaran_id')->references('id')->on('jadwal_pendaftaran')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            //
        });
    }
};

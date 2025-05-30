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
        Schema::table('jadwal_pendaftaran', function (Blueprint $table) {
            $table->boolean('status_manual')->nullable()->after('keterangan'); // null = ikuti tgl, true/false = override
        });
    }

    public function down()
    {
        Schema::table('jadwal_pendaftaran', function (Blueprint $table) {
            $table->dropColumn('status_manual');
        });
    }
};

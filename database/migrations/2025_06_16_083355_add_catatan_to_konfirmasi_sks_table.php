<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('konfirmasi_sks', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('konfirmasi_sks', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};

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
        // Update email users dari data mahasiswa
        DB::table('users')
            ->join('mahasiswas', 'users.id', '=', 'mahasiswas.user_id')
            ->whereNull('users.email')
            ->update([
                'users.email' => DB::raw('mahasiswas.email')
            ]);
    }

    public function down()
    {
        // Tidak perlu rollback untuk operasi data
    }
};

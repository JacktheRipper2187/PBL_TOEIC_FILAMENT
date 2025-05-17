<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('value_id')->nullable()->after('value'); // Kolom untuk bahasa Indonesia
            $table->string('value_en')->nullable()->after('value_id'); // Kolom untuk bahasa Inggris
        });

        // Memindahkan data dari kolom 'value' ke 'value_id' sebagai default
        DB::table('settings')->update([
            'value_id' => DB::raw('value'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('value_id');
            $table->dropColumn('value_en');
        });
    }
};
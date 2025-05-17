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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('title'); // Kolom untuk judul bahasa Indonesia
            $table->string('title_en')->nullable()->after('title_id'); // Kolom untuk judul bahasa Inggris
            $table->text('content_id')->nullable()->after('content'); // Kolom untuk konten bahasa Indonesia
            $table->text('content_en')->nullable()->after('content_id'); // Kolom untuk konten bahasa Inggris
            $table->string('thumbnail_id')->nullable()->after('thumbnail'); // Kolom untuk thumbnail bahasa Indonesia
            $table->string('thumbnail_en')->nullable()->after('thumbnail_id'); // Kolom untuk thumbnail bahasa Inggris
        });

        // Memindahkan data dari kolom 'title', 'content', dan 'thumbnail' ke kolom bilingual sebagai default
        DB::table('pendaftarans')->update([
            'title_id' => DB::raw('title'),
            'content_id' => DB::raw('content'),
            'thumbnail_id' => DB::raw('thumbnail'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('title_id');
            $table->dropColumn('title_en');
            $table->dropColumn('content_id');
            $table->dropColumn('content_en');
            $table->dropColumn('thumbnail_id');
            $table->dropColumn('thumbnail_en');
        });
    }
};
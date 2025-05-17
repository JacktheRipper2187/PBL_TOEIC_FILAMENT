<?php

use App\Models\setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('label');
            $table->string('type');
            $table->timestamps();
            $table->string('value_en')->nullable();
            $table->string('value_id')->nullable();
        });

        setting::create([
            'key' => '_site_name',
            'label' => 'Judul Situs',
            'type' => 'text',
            'value_en' => 'UPA Bahasa Polinema',
            'value_id' => 'UPA Bahasa Polinema',
        ]);

        setting::create([
            'key' => '_location',
            'label' => 'Alamat Kantor',
            'type' => 'text',
            'value_en' => 'Jl. Soekarno Hatta No. 9, Malang, East Java 65141',
            'value_id' => 'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur 65141',
        ]);
        setting::create([
            'key' => '_instagram',
            'label' => 'Instagram',
            'type' => 'text',
            'value_en' => 'https://www.instagram.com/upabahasa/',
            'value_id' => 'https://www.instagram.com/upabahasa/',
        ]);
        setting::create([
            'key' => '_whatsapp',
            'label' => 'Whatsapp',
            'type' => 'text',
            'value_en' => 'https://wa.me/6281234567890',
            'value_id' => 'https://wa.me/6281234567890',
        ]);
        setting::create([
            'key' => '_email',
            'label' => 'Email',
            'type' => 'text',
            'value_en' => 'upabahasapolinema@gmail.com',
            'value_id' => 'upabahasapolinema@gmail.com',
        ]);
        setting::create([
            'key' => '_site_description',
            'label' => 'Deskripsi Situs',
            'type' => 'text',
            'value_en' => 'If You Need Help, Please Contact Us',
            'value_id' => 'Jika Butuh Bantuan Silahkan Hubungi Kami',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
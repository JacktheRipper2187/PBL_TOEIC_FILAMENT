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
            $table->string('value')->nullable();
            $table->string('type');
            $table->timestamps();

        });

        setting ::create([
            'key' => '_site_name',
            'label' => 'Judul Situs',
            'value' => 'UPA Bahasa Polinema',   
            'type' => 'text',
        ]);

        setting ::create([
            'key' => '_location',
            'label' => 'Alamat Kantor',
            'value' => 'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur 65141',
            'type' => 'text',
        ]);
        setting ::create([
            'key' => '_instagram',
            'label' => 'Instagram',
            'value' => 'https://www.instagram.com/upabahasa/',
            'type' => 'text',
        ]);
        setting ::create([
            'key' => '_whatsapp',
            'label' => 'Whatsapp',
            'value' => 'https://wa.me/6281234567890',
            'type' => 'text',
        ]);
        setting ::create([
            'key' => '_email',
            'label' => 'Email',
            'value' => 'upabahasapolinema@gmail.com',        
            'type' => 'text',
        ]);
         setting ::create([
            'key' => '_site_description',
            'label' => 'Deskripsi Situs',
            'value' => 'Jika Butuh Bantuan Silahkan Hubungi Kami',
            'type' => 'text',
           
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

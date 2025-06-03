<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilToeicsTable extends Migration
{
    public function up()
    {
        Schema::create('hasil_toeic', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->integer('l');
            $table->integer('r');
            $table->integer('tot');
            $table->string('group')->nullable();
            $table->string('position')->nullable();
            $table->string('category')->nullable();
            $table->date('test_date')->nullable();
            $table->string('keterangan')->nullable();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_toeic');
    }
}

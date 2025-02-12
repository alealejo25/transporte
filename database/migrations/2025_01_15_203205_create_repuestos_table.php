<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestosTable extends Migration {
    public function up() {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->integer('cantidad_lnf');
            $table->integer('cantidad_leagas');
            $table->integer('cantidad_malebo');
            $table->integer('marca_id')->nullable()->unsigned();
            $table->boolean('condicion');
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcarepuestos');
  
        });
    }

    public function down() {
        Schema::dropIfExists('repuestos');
    }
}

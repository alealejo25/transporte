<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cargargasoil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargargasoil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('litros');
           
            $table->integer('coche_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('coche_id')->references('id')->on('coches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('cargargasoil');//
    }
}

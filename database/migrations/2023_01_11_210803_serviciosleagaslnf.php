<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Serviciosleagaslnf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('serviciosleagaslnf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('turno_id')->unsigned()->nullable();
            $table->integer('linea_id')->unsigned()->nullable();
            $table->integer('kmsemana')->nullable();
            $table->integer('kmsabado')->nullable();
            $table->integer('kmdomingo')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('turno_id')->references('id')->on('turnos');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('ramal_id')->references('id')->on('ramales');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('serviciosleagaslnf');//
    }
}

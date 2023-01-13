<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boletosleagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletosleagas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('iniciotarjeta');
            $table->integer('fintarjeta');
            $table->integer('cantpasajes');
            $table->decimal('recaudacion',10,2);
            $table->time('horainicio',0);
            $table->time('horafin',0);
            $table->time('horastotal',0);
            $table->time('horassobrantes',0);
            $table->decimal('valorhorasrestantes',10,2);
            $table->integer('gasoil');
            $table->integer('toquesanden');
            $table->decimal('valortoquesanden',10,2);
            $table->string('observaciones',120)->nullable();
            $table->integer('condicion')->unsigned()->default(0);
            $table->integer('linea_id')->nullable()->unsigned();
            $table->integer('chofer_id')->nullable()->unsigned();
            $table->integer('servicio_id')->nullable()->unsigned();
            $table->integer('turno_id')->nullable()->unsigned();
            $table->integer('coche_id')->nullable()->unsigned();
            $table->biginteger('user_id')->unsigned()->nullable();
            
            $table->timestamps();

            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('chofer_id')->references('id')->on('choferesleagaslnf');
            $table->foreign('servicio_id')->references('id')->on('serviciosleagaslnf');
            $table->foreign('turno_id')->references('id')->on('turnos');
            $table->foreign('coche_id')->references('id')->on('coches');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletosleagas');//
    }
}

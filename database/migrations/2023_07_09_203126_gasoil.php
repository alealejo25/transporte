<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gasoil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasoil', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('numero');
            $table->integer('t1apertura');
            $table->integer('t1cierre');
            $table->integer('t1diferencia');
            $table->integer('t1consumo');
            $table->integer('t1nivel');
            $table->integer('t1saldo');
            $table->integer('t1ingreso')->nullable();

            $table->integer('t2apertura');
            $table->integer('t2cierre');
            $table->integer('t2diferencia');
            $table->integer('t2consumo');
            $table->integer('t2nivel');
            $table->integer('t2saldo');
            $table->integer('t2ingreso')->nullable();

            $table->integer('l10total')->nullable();
            $table->integer('l110total')->nullable();
            $table->integer('l142total')->nullable();
            $table->integer('l118total')->nullable();
            $table->integer('l121total')->nullable();
            $table->integer('l122total')->nullable();
            $table->integer('l131total')->nullable();

            $table->string('responsable',60)->nullable();
            $table->biginteger('user_id')->unsigned()->nullable();

            $table->integer('empresa_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
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
          Schema::dropIfExists('gasoil');//
    }
}

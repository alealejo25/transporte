<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stockboletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockboletos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->string('codigo',5);
            $table->integer('serie')->unsigned()->default(0);
            $table->integer('inicio')->unsigned()->default(0);
            $table->integer('fin')->unsigned()->default(0);
            $table->integer('actual')->unsigned()->default(0);
            $table->integer('activo')->unsigned()->default(0);
            $table->integer('posicion')->unsigned()->default(0);
            $table->integer('chofer_id')->nullable()->unsigned();
            $table->integer('servicio_id')->nullable()->unsigned();
            $table->timestamps();
 

            $table->foreign('chofer_id')->references('id')->on('choferesleagaslnf');
            $table->foreign('servicio_id')->references('id')->on('servicios');
 

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockboletos');
    }
}

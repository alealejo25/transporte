<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cochesboletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::create('cochesboletos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iniciotarjeta');
            $table->integer('fintarjeta');
            $table->integer('cantpasajes');
            $table->decimal('recaudacion',10,2);
            $table->string('taller',2)->nullable();
            $table->string('motivo_cambio',150)->nullable();
            $table->integer('condicion')->unsigned()->default(0);
            $table->integer('coche_id')->nullable()->unsigned();
            $table->integer('boletosleagas_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('boletosleagas_id')->references('id')->on('boletosleagas');
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
        Schema::dropIfExists('cochesboletos');//
    }
}

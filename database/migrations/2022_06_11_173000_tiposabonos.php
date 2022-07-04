<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposAbonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposabonos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo',35);
            $table->integer('cantidad')->unsigned();
            $table->integer('costo100')->unsigned();
            $table->integer('costo101')->unsigned();
            $table->integer('costo103')->unsigned();
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoabonos');//
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Movimientoremitorepuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('movimientoremitorepuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('remitorepuestos_id')->nullable()->unsigned();
            $table->integer('repuestos_id')->nullable()->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            
            $table->foreign('remitorepuestos_id')->references('id')->on('remitorepuestos');
            $table->foreign('repuestos_id')->references('id')->on('repuestos');
 
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientoremitorepuestos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ramales extends Migration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->integer('linea_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('linea_id')->references('id')->on('lineas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('ramales');//
    }
}

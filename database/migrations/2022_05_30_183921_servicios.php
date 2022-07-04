<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',8);
            $table->string('descripcion',30);
            $table->integer('numero');
            $table->string('tipo_dia',5);
            $table->string('turno',10);
            $table->string('toma',10);
            $table->string('deja',10);
            $table->string('estado',30)->nullable();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            
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
        Schema::dropIfExists('servicios');
    }
}

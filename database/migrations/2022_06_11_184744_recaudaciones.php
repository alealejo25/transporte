<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recaudaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recaudaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('desde');
            $table->date('hasta');
            $table->date('fecha');
            $table->decimal('abono',10,2);
            $table->decimal('posnet',10,2);
            $table->decimal('egresos',10,2);
            $table->decimal('totalingresos',10,2);
            $table->decimal('montoneto',10,2);
            $table->integer('diez')->unsigned();
            $table->integer('veinte')->unsigned();
            $table->integer('cincuenta')->unsigned();
            $table->integer('cien')->unsigned();
            $table->integer('doscientos')->unsigned();
            $table->integer('quinientos')->unsigned();
            $table->integer('mil')->unsigned();
            $table->decimal('fisico',10,2);
            $table->string('observacion',100);
            $table->integer('condicion')->unsigned()->default(0);
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
        Schema::dropIfExists('recaudaciones');//
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pagometropolitana extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pagometropolitana', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrocomprobante',20);
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->decimal('importe',10,2);
            $table->decimal('servmetro',10,2)->nullable();
            $table->decimal('fondo',10,2)->nullable();
            $table->decimal('iibb',10,2)->nullable();
            $table->decimal('totaldeducciones',10,2)->nullable();
            $table->decimal('netoapagar',10,2)->nullable();
            $table->string('observacion',150)->nullable();
            $table->string('estado',30)->nullable();
            $table->integer('caja_id')->unsigned();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('caja_id')->references('id')->on('cajas');
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
         Schema::dropIfExists('pagometropolitana');
    }

}

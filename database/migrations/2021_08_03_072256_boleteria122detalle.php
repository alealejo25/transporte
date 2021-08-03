<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boleteria122Detalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('boleteria122detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dia');
            $table->decimal('totalarendirp',8,2)->nullable();
            $table->integer('abonodesdep')->nullable();
            $table->integer('abonohastap')->nullable();
            $table->decimal('totalp',8,2)->nullable();
            $table->decimal('totalarendiru',8,2)->nullable();
            $table->integer('abonodesdeu')->nullable();
            $table->integer('abonohastau')->nullable();
            $table->decimal('totalu',8,2)->nullable();
            $table->decimal('totalarendirm',8,2)->nullable();
            $table->integer('cierrelote')->nullable();
            $table->decimal('totalm',8,2)->nullable();
            $table->integer('boleteria122_id')->unsigned()->nullable();
            $table->string('estado',30)->nullable();
            
            $table->foreign('boleteria122_id')->references('id')->on('boleteria122');
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
        Schema::dropIfExists('boleteria122detalle');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boleteria122 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boleteria122', function (Blueprint $table) {
            $table->increments('id');
            $table->string('puntodeventa',20);
            $table->string('responsable',20);
            $table->string('observacion',150);
            $table->date('fecha');
            $table->decimal('total',8,2)->nullable();
            $table->string('estado',30)->nullable();

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
        Schema::dropIfExists('boleteria122');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaccioniv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('transaccioniv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_pasajes')->unsigned();
            $table->decimal('montounitario',10,2);
            $table->decimal('montototal',10,2);
            $table->date('fecha');
            $table->date('fechavencimiento');
            $table->integer('destinosivterminal_id')->unsigned()->nullable();
            $table->string('tipo',35);
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('destinosivterminal_id')->references('id')->on('destinosivterminal');
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
        Schema::dropIfExists('transaccioniv');
    }
}

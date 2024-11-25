<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ventasivterminal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventasivterminal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nroboleto')->unsigned();
            $table->integer('transaccioniv_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('transaccioniv_id')->references('id')->on('transaccioniv');
                        
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventasivterminal');
    }
}

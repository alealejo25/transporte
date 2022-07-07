<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanchasTafi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planchastafi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado',15);
            $table->string('motivo',40)->nullable();
            $table->string('color',8);
            $table->string('user_anulacion',40)->nullable();
            $table->date('fechaanulacion')->nullable();
            $table->date('fechacarga');
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->integer('usercompra_id')->unsigned()->nullable();
            $table->integer('numero')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('usercompra_id')->references('id')->on('abonados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('planchastafi');//
    }
}

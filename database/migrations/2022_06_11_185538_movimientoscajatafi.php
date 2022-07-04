<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovimientosCajaTafi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientoscajatafi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo',30);
            $table->string('tipo_movimiento',10);
            $table->string('descripcion',50);
            $table->date('fecha');
            $table->decimal('importe',10,2);
            $table->decimal('importe_final',10,2);
            $table->integer('cierre')->unsigned()->default(0);
            $table->integer('condicion')->unsigned()->default(0);
            $table->integer('cierre_dia_tafi_id')->unsigned()->nullable();
            $table->biginteger('user_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('cierre_dia_tafi_id')->references('id')->on('cierresdiatafi');
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
       Schema::dropIfExists('movimientoscajatafi');//
    }
}

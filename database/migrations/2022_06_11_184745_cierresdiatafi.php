<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CierresDiaTafi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierresdiatafi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('caja_inicial',10,2);
            $table->decimal('venta',10,2);
            $table->decimal('gastos',10,2);
            $table->integer('nrolote')->unsigned();
            $table->decimal('montolote',10,2);
            $table->decimal('caja_final',10,2);
            $table->decimal('caja_final_fisica',10,2);
            $table->decimal('caja_diferencia',10,2);
            $table->decimal('monto_anuladas',10,2);
            $table->integer('planchas_impresas')->unsigned();
            $table->integer('planchas_dañada')->unsigned();
            $table->integer('planchas_vendidas')->unsigned()->nullable();
            $table->integer('planchas_anuladas')->unsigned()->nullable();
            $table->integer('cierre')->unsigned()->default(0);
            $table->decimal('ganancialnf',10,2);
            $table->decimal('gananciaelrayo',10,2);
            $table->decimal('gananciatotallnf',10,2);
            $table->string('observacion',100);
            $table->integer('condicion')->unsigned()->default(0);
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->integer('recaudacion_id')->unsigned()->nullable();
            
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('recaudacion_id')->references('id')->on('recaudaciones');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cierresdiatafi');//
    }
}

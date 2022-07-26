<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VentasTafi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ventastafi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->integer('cantidad')->unsigned();
            $table->integer('numero')->unsigned();
            $table->integer('impresion')->unsigned();
            $table->decimal('montototal',10,2);
            $table->integer('anulado')->unsigned()->default(0);
            $table->string('boleto',3);
            $table->string('desde',30);
            $table->string('hasta',30);
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->integer('abonado_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('abonado_id')->references('id')->on('abonados');

            
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventastafi');//
    }
}

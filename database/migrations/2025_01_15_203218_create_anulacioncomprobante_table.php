<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnulacioncomprobanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anulacioncomprobante', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('comprobanterepuesto_id')->nullable()->unsigned();
            $table->string('motivo');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('comprobanterepuesto_id')->references('id')->on('comprobanterepuestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anulacioncomprobante');
    }
}

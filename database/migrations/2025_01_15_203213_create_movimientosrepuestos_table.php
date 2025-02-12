<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosrepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientosrepuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('repuesto_id')->nullable()->unsigned();
            $table->integer('cantidad');
            $table->string('descripcion');
             $table->integer('comprobanterepuesto_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('comprobanterepuesto_id')->references('id')->on('comprobanterepuestos');
            $table->foreign('repuesto_id')->references('id')->on('repuestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientosrepuestos');
    }
}

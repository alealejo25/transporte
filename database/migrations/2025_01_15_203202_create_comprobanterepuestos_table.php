<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobanterepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobanterepuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrocomprobante')->unique();
            $table->integer('tipocomprobante_id')->nullable()->unsigned();
            $table->integer('turnopañol_id')->nullable()->unsigned();
            $table->date('fecharecepcion');
            $table->date('fechacomprobante');
            $table->integer('proveedor_id')->nullable()->unsigned();
            $table->integer('estadocomprobante_id')->nullable()->unsigned();
            $table->timestamps();

             $table->foreign('tipocomprobante_id')->references('id')->on('tipocomprobantes');
             $table->foreign('turnopañol_id')->references('id')->on('turnopañol');
             $table->foreign('proveedor_id')->references('id')->on('proveedores');
             $table->foreign('estadocomprobante_id')->references('id')->on('estadocomprobantes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobanterepuestos');
    }
}

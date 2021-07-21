<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comprasvarias extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('comprasvarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrocomprobante',20)->nullable();
            $table->string('tipocomprobante',20)->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('importe',10,2)->nullable();
            $table->string('observacion',150)->nullable();
            $table->string('estado',30)->nullable();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->integer('opcomprasvarias_id')->unsigned()->nullable();

            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('opcomprasvarias_id')->references('id')->on('opcomprasvarias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('comprasvarias');
    }
}

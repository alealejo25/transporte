<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
  public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coche_id')->nullable()->unsigned();
            $table->integer('empleado_id')->nullable()->unsigned();
            $table->date('fecha_service');
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Finalizado', 'Cancelado'])->default('Pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('coche_id')->references('id')->on('coches');
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }
    public function down()
    {
        Schema::dropIfExists('services');
    }
}

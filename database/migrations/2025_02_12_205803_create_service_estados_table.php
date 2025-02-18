<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceEstadosTable extends Migration
{
    public function up()
    {
        Schema::create('service_estados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable()->unsigned();
            $table->integer('empleado_id')->nullable()->unsigned();
            $table->enum('estado_anterior', ['Pendiente', 'En Proceso', 'Finalizado', 'Cancelado'])->nullable();
            $table->enum('estado_nuevo', ['Pendiente', 'En Proceso', 'Finalizado', 'Cancelado']);
            $table->timestamp('fecha_cambio')->useCurrent();
            $table->timestamps();
             $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }
    public function down()
    {
        Schema::dropIfExists('service_estados');
    }
}

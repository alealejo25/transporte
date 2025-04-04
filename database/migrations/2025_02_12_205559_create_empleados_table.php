<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
             $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->string('puesto');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Abonados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',25);
            $table->string('apellido',25);
            $table->string('dni',8)->unique();
            $table->string('direccion',100);
            $table->string('nrocelular',11);
            $table->string('colegio_empresa',100);
            $table->string('turno',7);
            $table->string('desde',30);
            $table->string('hasta',30);
            $table->string('codigo',3)->nullable();
            $table->string('boleto',3)->nullable();
            $table->date('fechapresentacion')->nullable();
            $table->date('fechavencimiento')->nullable();
            $table->string('docpresentada',2)->nullable();
            $table->string('documentacion',75)->nullable();

            $table->integer('tipo_abono_id')->unsigned();
            $table->string('estado',30)->nullable();
            $table->timestamps();

            $table->foreign('tipo_abono_id')->references('id')->on('tiposabonos');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonados');//
    }
}

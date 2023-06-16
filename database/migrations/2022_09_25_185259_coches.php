<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Coches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interno');
            $table->integer('nroempresa');
            $table->string('patente',10);
            $table->string('activo',1);
            $table->date('fechavtv')->nullable();
            $table->date('vencimientovtv')->nullable();
            $table->integer('año');
            $table->string('motor',30);
            $table->string('chasis',30);
            $table->integer('nroasientos');
            $table->integer('km')->nullable();
            
            $table->date('ultimoservice')->nullable();
            $table->date('fecha_ingreso');
            $table->date('fecha_egreso')->nullable();
            $table->integer('valor');
            $table->string('foto',256)->nullable();
            $table->integer('condicion')->unsigned()->default(0);
            $table->integer('carroceria_id')->nullable()->unsigned();
            $table->integer('modelo_id')->nullable()->unsigned();
            $table->integer('marca_id')->nullable()->unsigned();
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('carroceria_id')->references('id')->on('carrocerias');
            $table->foreign('modelo_id')->references('id')->on('modelos');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coches');//
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Choferesleagaslnf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('choferesleagaslnf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('legajo');
            $table->string('nombre',30);
            $table->string('apellido',30);
            $table->string('dni',8);
            $table->string('cuil',11);
            $table->string('direccion',100);
            $table->integer('codpos');
            $table->integer('localidad_id')->nullable()->unsigned();
            $table->string('nrocelular',11);
            $table->string('nrofijo',11);
            $table->date('fechanac');
            $table->string('sexo',1);
            $table->string('estadocivil',15)->nullable();
            $table->string('nacionalidad',25);
            $table->string('email',60)->nullable();
            $table->date('fechaingreso');
            $table->string('activo',1);
            $table->date('fechaactivohasta')->nullable();
            $table->string('motivodesactivar',250)->nullable();
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->integer('gremio_id')->nullable()->unsigned();
            $table->integer('categoriachofer_id')->nullable()->unsigned();
            $table->integer('tipocontratacion_id')->nullable()->unsigned();
            $table->integer('obrasocial_id')->nullable()->unsigned();
            $table->string('foto',256)->nullable();
            $table->integer('condicion')->unsigned()->default(0);

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->foreign('gremio_id')->references('id')->on('gremios');
            $table->foreign('categoriachofer_id')->references('id')->on('categorias_cho');
            $table->foreign('tipocontratacion_id')->references('id')->on('tiposcontratacion');
            $table->foreign('obrasocial_id')->references('id')->on('obrasociales');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('choferesleagaslnf');//
    }
}

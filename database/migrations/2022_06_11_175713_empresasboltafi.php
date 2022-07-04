<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresasBolTafi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresasboltafi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',35);
            $table->string('nombre_corto',35);
            $table->integer('porcentaje')->unsigned();
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
        Schema::dropIfExists('empresasboltafi');//
    }
}

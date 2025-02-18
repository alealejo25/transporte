<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetallesTable extends Migration
{
    public function up()
    {
        Schema::create('service_detalles', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('service_id')->nullable()->unsigned();
            $table->integer('repuesto_id')->nullable()->unsigned();
            $table->integer('cantidad');
            
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('repuesto_id')->references('id')->on('repuestos');
        });
    }
    public function down()
    {
        Schema::dropIfExists('service_detalles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Opcomprasvarias extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('opcomprasvarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrocomprobante',20)->nullable();
            $table->date('fechainicio')->nullable();
            $table->date('fechacierre')->nullable();
            $table->decimal('montolnf',10,2)->nullable();
            $table->decimal('montol',10,2)->nullable();
            $table->decimal('gastoslnf',10,2)->nullable();
            $table->decimal('gastosl',10,2)->nullable();
            $table->decimal('rendicionlnf',10,2)->nullable();
            $table->decimal('rendicionl',10,2)->nullable();
            $table->decimal('diferencialnf',10,2)->nullable();
            $table->decimal('diferencial',10,2)->nullable();
            $table->string('observacion',150)->nullable();
            $table->string('estado',30)->nullable();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('opcomprasvarias');
    }

}

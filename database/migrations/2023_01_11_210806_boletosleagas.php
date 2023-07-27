<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boletosleagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletosleagas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->date('fecha');
            $table->decimal('recaudaciontotal',10,2);
            $table->integer('pasajestotal');
            $table->time('horainicio',0);
            $table->time('horafin',0);
            $table->time('horastotal',0)->nullable();//modificado
            $table->string('alargue',1)->nullable();//nuevo
            $table->string('cortado',1)->nullable();////nuevo
            $table->string('tipo',1)->nullable();//nuevo
            $table->string('doblenegro',1)->nullable();////nuevo
            $table->string('normal',1)->nullable();//nuevo
            $table->time('horastotalalargue',0)->nullable();//nuevo
            $table->time('horassobrantes',0)->nullable();//modificado
            $table->decimal('valorhorasrestantes',10,2);
            $table->integer('gasoiltotal')->nullable();

            $table->integer('toquesanden');
            $table->decimal('valortoquesanden',10,2);
            $table->string('observaciones',120)->nullable();
            $table->integer('condicion')->unsigned()->default(0);
            $table->integer('linea_id')->nullable()->unsigned();
            $table->integer('chofer_id')->nullable()->unsigned();
            $table->integer('servicio_id')->nullable()->unsigned();
            $table->biginteger('user_id')->unsigned()->nullable();
            
            $table->timestamps();

            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('chofer_id')->references('id')->on('choferesleagaslnf');
            $table->foreign('servicio_id')->references('id')->on('serviciosleagaslnf');
            
            $table->foreign('coche_id')->references('id')->on('coches');
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
        Schema::dropIfExists('boletosleagas');//
    }
}

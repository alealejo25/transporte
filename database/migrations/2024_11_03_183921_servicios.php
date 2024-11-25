<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaasignacion');
            $table->date('fechaservicio');
            $table->string('dia',15)->nullable();
            $table->string('observacion',30);
            $table->string('estado',15)->nullable();
            $table->integer('inicialcod6a')->unsigned()->default(0);
            $table->integer('inicialcod6b')->unsigned()->default(0);
            $table->integer('inicialcod7a')->unsigned()->default(0);
            $table->integer('inicialcod7b')->unsigned()->default(0);
            $table->integer('inicialcod8a')->unsigned()->default(0);
            $table->integer('inicialcod8b')->unsigned()->default(0);
            $table->integer('inicialcod10a')->unsigned()->default(0);
            $table->integer('inicialcod10b')->unsigned()->default(0);
            $table->integer('inicialcod12a')->unsigned()->default(0);
            $table->integer('inicialcod12b')->unsigned()->default(0);
            $table->integer('inicialcod14a')->unsigned()->default(0);
            $table->integer('inicialcod14b')->unsigned()->default(0);
            $table->integer('inicialcod15a')->unsigned()->default(0);
            $table->integer('inicialcod15b')->unsigned()->default(0);
            $table->integer('inicialcod18a')->unsigned()->default(0);
            $table->integer('inicialcod18b')->unsigned()->default(0);
            $table->integer('inicialcod21a')->unsigned()->default(0);
            $table->integer('inicialcod21b')->unsigned()->default(0);
            $table->integer('inicialcod23a')->unsigned()->default(0);
            $table->integer('inicialcod23b')->unsigned()->default(0);
            $table->integer('inicialcod27a')->unsigned()->default(0);
            $table->integer('inicialcod27b')->unsigned()->default(0);
            $table->integer('inicialcod30a')->unsigned()->default(0);
            $table->integer('inicialcod30b')->unsigned()->default(0);
            $table->integer('inicialcod32a')->unsigned()->default(0);
            $table->integer('inicialcod32b')->unsigned()->default(0);
            $table->integer('inicialabonoa')->unsigned()->default(0);
            $table->integer('inicialabonob')->unsigned()->default(0);

            $table->integer('fincod6a')->unsigned()->default(0);
            $table->integer('fincod6b')->unsigned()->default(0);
            $table->integer('fincod7a')->unsigned()->default(0);
            $table->integer('fincod7b')->unsigned()->default(0);
            $table->integer('fincod8a')->unsigned()->default(0);
            $table->integer('fincod8b')->unsigned()->default(0);
            $table->integer('fincod10a')->unsigned()->default(0);
            $table->integer('fincod10b')->unsigned()->default(0);
            $table->integer('fincod12a')->unsigned()->default(0);
            $table->integer('fincod12b')->unsigned()->default(0);
            $table->integer('fincod14a')->unsigned()->default(0);
            $table->integer('fincod14b')->unsigned()->default(0);
            $table->integer('fincod15a')->unsigned()->default(0);
            $table->integer('fincod15b')->unsigned()->default(0);
            $table->integer('fincod18a')->unsigned()->default(0);
            $table->integer('fincod18b')->unsigned()->default(0);
            $table->integer('fincod21a')->unsigned()->default(0);
            $table->integer('fincod21b')->unsigned()->default(0);
            $table->integer('fincod23a')->unsigned()->default(0);
            $table->integer('fincod23b')->unsigned()->default(0);
            $table->integer('fincod27a')->unsigned()->default(0);
            $table->integer('fincod27b')->unsigned()->default(0);
            $table->integer('fincod30a')->unsigned()->default(0);
            $table->integer('fincod30b')->unsigned()->default(0);
            $table->integer('fincod32a')->unsigned()->default(0);
            $table->integer('fincod32b')->unsigned()->default(0);
            $table->integer('finabonoa')->unsigned()->default(0);
            $table->integer('finabonob')->unsigned()->default(0);

            $table->decimal('abonosa',10,2);
            $table->decimal('cod6a',10,2);
            $table->decimal('cod7a',10,2);
            $table->decimal('cod8a',10,2);
            $table->decimal('cod10a',10,2);
            $table->decimal('cod12a',10,2);
            $table->decimal('cod14a',10,2);
            $table->decimal('cod15a',10,2);
            $table->decimal('cod18a',10,2);
            $table->decimal('cod21a',10,2);
            $table->decimal('cod23a',10,2);
            $table->decimal('cod27a',10,2);
            $table->decimal('cod30a',10,2);
            $table->decimal('cod32a',10,2);

            $table->decimal('abonosb',10,2);
            $table->decimal('cod6b',10,2);
            $table->decimal('cod7b',10,2);
            $table->decimal('cod8b',10,2);
            $table->decimal('cod10b',10,2);
            $table->decimal('cod12b',10,2);
            $table->decimal('cod14b',10,2);
            $table->decimal('cod15b',10,2);
            $table->decimal('cod18b',10,2);
            $table->decimal('cod21b',10,2);
            $table->decimal('cod23b',10,2);
            $table->decimal('cod27b',10,2);
            $table->decimal('cod30b',10,2);
            $table->decimal('cod32b',10,2);

            $table->biginteger('user_id')->unsigned()->nullable();
            $table->integer('codigoservicio_id')->nullable()->unsigned();
            $table->integer('coche_id')->unsigned()->nullable();
            $table->integer('choferesleagaslnf_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
 
            $table->foreign('coche_id')->references('id')->on('coches');
            $table->foreign('choferesleagaslnf_id')->references('id')->on('choferesleagaslnf');
            $table->foreign('codigoservicio_id')->references('id')->on('codigoservicios');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pagoworldline extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pagoworldline', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrocomprobante',20);
            $table->date('fecha');

            $table->integer('pasajenormal')->nullable();
            $table->decimal('importenormal',10,2)->nullable();

            $table->integer('pasajeprim')->nullable();
            $table->decimal('importeprim',10,2)->nullable();

            $table->integer('pasajesec')->nullable();
            $table->decimal('importesec',10,2)->nullable();

            $table->integer('pasajeuniv')->nullable();
            $table->decimal('importeuniv',10,2)->nullable();

            $table->decimal('subtotal',10,2)->nullable();

            $table->decimal('mh08',10,2)->nullable();
            $table->decimal('mh09',10,2)->nullable();
            $table->decimal('mh42',10,2)->nullable();
            $table->decimal('mh44',10,2)->nullable();
            $table->decimal('mh45',10,2)->nullable();
            $table->decimal('mh47',10,2)->nullable();
            $table->decimal('mh48',10,2)->nullable();
            $table->decimal('mh49',10,2)->nullable();
            $table->decimal('mh50',10,2)->nullable();
            $table->decimal('mh51',10,2)->nullable();
            $table->decimal('mh52',10,2)->nullable();
            
            $table->decimal('u429',10,2)->nullable();
            $table->decimal('u430',10,2)->nullable();
            $table->decimal('u431',10,2)->nullable();
            $table->decimal('u462',10,2)->nullable();

            $table->decimal('subtotalretenciones',10,2)->nullable();

            $table->decimal('netoapagar',10,2)->nullable();
            $table->string('observacion',150)->nullable();
            $table->string('estado',30)->nullable();
            $table->integer('caja_id')->unsigned();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('caja_id')->references('id')->on('cajas');
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
         Schema::dropIfExists('pagoworldline');
    }
}

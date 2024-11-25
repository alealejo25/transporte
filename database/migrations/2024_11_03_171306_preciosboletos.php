<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preciosboletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precioboletos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechainicio')->nullable();
            $table->date('fechahasta')->nullable();
            $table->decimal('abonos',10,2);
            $table->decimal('cod6',10,2);
            $table->decimal('cod7',10,2);
            $table->decimal('cod8',10,2);
            $table->decimal('cod10',10,2);
            $table->decimal('cod12',10,2);
            $table->decimal('cod14',10,2);
            $table->decimal('cod15',10,2);
            $table->decimal('cod18',10,2);
            $table->decimal('cod21',10,2);
            $table->decimal('cod23',10,2);
            $table->decimal('cod27',10,2);
            $table->decimal('cod30',10,2);
            $table->decimal('cod32',10,2);
            $table->integer('estado')->unsigned()->default(0);
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
        Schema::dropIfExists('precioboletos');
    }
}

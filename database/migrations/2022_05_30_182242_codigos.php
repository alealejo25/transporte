<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Codigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('codigos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',5);
            $table->decimal('valoractual',10,2)->nullable();
            $table->decimal('valoranterior',10,2)->nullable();
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
     Schema::dropIfExists('codigos');
    }
}

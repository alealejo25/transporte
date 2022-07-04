<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Choferes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',25);
            $table->string('apellido',25);
            $table->string('dni',25)->unique();
            $table->string('direccion',100);
            $table->date('fechanac');
            $table->string('nrocelular',11);
            $table->decimal('saldo',8,2)->nullable();

            $table->integer('cod6_r1')->nullable();
            $table->integer('cod6_res_r1')->nullable();
            $table->integer('cod6_r2')->nullable();
            $table->integer('cod6_res_r2')->nullable();

            $table->integer('cod7_r1')->nullable();
            $table->integer('cod7_res_r1')->nullable();
            $table->integer('cod7_r2')->nullable();
            $table->integer('cod7_res_r2')->nullable();

            $table->integer('cod8_r1')->nullable();
            $table->integer('cod8_res_r1')->nullable();
            $table->integer('cod8_r2')->nullable();
            $table->integer('cod8_res_r2')->nullable();

            $table->integer('cod10_r1')->nullable();
            $table->integer('cod10_res_r1')->nullable();
            $table->integer('cod10_r2')->nullable();
            $table->integer('cod10_res_r2')->nullable();

            $table->integer('cod12_r1')->nullable();
            $table->integer('cod12_res_r1')->nullable();
            $table->integer('cod12_r2')->nullable();
            $table->integer('cod12_res_r2')->nullable();

            $table->integer('cod14_r1')->nullable();
            $table->integer('cod14_res_r1')->nullable();
            $table->integer('cod14_r2')->nullable();
            $table->integer('cod14_res_r2')->nullable();

            $table->integer('cod15_r1')->nullable();
            $table->integer('cod15_res_r1')->nullable();
            $table->integer('cod15_r2')->nullable();
            $table->integer('cod15_res_r2')->nullable();

            $table->integer('cod18_r1')->nullable();
            $table->integer('cod18_res_r1')->nullable();
            $table->integer('cod18_r2')->nullable();
            $table->integer('cod18_res_r2')->nullable();

            $table->integer('cod21_r1')->nullable();
            $table->integer('cod21_res_r1')->nullable();
            $table->integer('cod21_r2')->nullable();
            $table->integer('cod21_res_r2')->nullable();

            $table->integer('cod23_r1')->nullable();
            $table->integer('cod23_res_r1')->nullable();
            $table->integer('cod23_r2')->nullable();
            $table->integer('cod23_res_r2')->nullable();            

            $table->integer('cod27_r1')->nullable();
            $table->integer('cod27_res_r1')->nullable();
            $table->integer('cod27_r2')->nullable();
            $table->integer('cod27_res_r2')->nullable();

            $table->integer('cod30_r1')->nullable();
            $table->integer('cod30_res_r1')->nullable();
            $table->integer('cod30_r2')->nullable();
            $table->integer('cod30_res_r2')->nullable();

            $table->integer('cod32_r1')->nullable();
            $table->integer('cod32_res_r1')->nullable();
            $table->integer('cod32_r2')->nullable();
            $table->integer('cod32_res_r2')->nullable();

            $table->integer('codabono_r1')->nullable();
            $table->integer('codabono_res_r1')->nullable();
            $table->integer('codabono_r2')->nullable();
            $table->integer('codabono_res_r2')->nullable();

            $table->string('foto',256)->nullable();
            $table->integer('condicion')->unsigned()->default(0);

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
        Schema::dropIfExists('choferes');
    }
}

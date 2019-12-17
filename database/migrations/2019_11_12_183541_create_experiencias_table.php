<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidatos_id')->unsigned();
            $table->string('empresa', 50);
            $table->string('ubicacion', 100);
            $table->string('puesto', 128);
            $table->integer('tipo_contrato')->unsigned();
            $table->integer('mes_comienza')->unsigned();
            $table->integer('anio_comienza')->unsigned();
            $table->integer('mes_termina')->unsigned();
            $table->integer('anio_termina')->unsigned();
            $table->boolean('puesto_actual');
            $table->string('titular', 100);
            $table->string('descripcion', 256);
            $table->string('url', 256);
            $table->string('fichero', 256);
            $table->boolean('mostrado');

            $table->timestamps();
//            $table->foreign('candidatos_id') ->references('id')->on('candidatos')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiencias');
    }
}

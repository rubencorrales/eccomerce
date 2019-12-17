<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidatos_id')->unsigned();
            $table->string('titulacion', 128);
            $table->string('centro', 128);
            $table->integer('anio_inicio')->unsigned();
            $table->integer('anio_fin')->unsigned();
            $table->string('nota', 30);
            $table->string('actividades', 256);
            $table->string('descripcion', 256);
            $table->string('fichero', 256);
            $table->string('url', 256);
            $table->boolean('mostrado');

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
        Schema::dropIfExists('formacions');
    }
}

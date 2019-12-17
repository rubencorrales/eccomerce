<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 100);
            $table->string('password', 128);
            $table->string('name', 50);
            $table->string('apellidos', 100);
            $table->string('dni', 10);
            $table->string('direccion', 100);
            $table->string('localidad', 40);
            $table->string('provincia', 40);
            $table->integer('cp');
            $table->string('pais', 40);
            $table->string('imagen', 255);
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
        Schema::dropIfExists('candidatos');
    }
}

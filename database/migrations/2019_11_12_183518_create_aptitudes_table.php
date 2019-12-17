<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAptitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aptitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidatos_id')->unsigned();
            $table->string('nombre', 50);
            $table->integer('nivel')->unsigned();
            $table->integer('anios_experiencia')->unsigned();
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
        Schema::dropIfExists('aptitudes');
    }
}

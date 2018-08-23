<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta_users', function (Blueprint $table) {
            $table->increments('id');
            //Primera llave foranea
            // $table->integer('hotel_id')->unsigned();
            // $table->foreign('hotel_id')->references('id')->on('hotels');
            // $table->text('hotel_id');
            //Segunda llave foranea
            // $table->integer('cadena_id')->unsigned();
            // $table->foreign('cadena_id')->references('id')->on('cadenas');
            //Tercera llave foranea
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //Cuarta llave foranea
            $table->integer('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')->references('id')->on('encuestas');
            //Quinta llave foranea
            $table->integer('estatus_id')->unsigned();
            $table->foreign('estatus_id')->references('id')->on('estatus');

            $table->boolean('estatus_res');

            $table->date('fecha_inicial');
            $table->date('fecha_corresponde');
            $table->date('fecha_fin');

            $table->text('shell_data');
            $table->text('shell_status');
            // $table->text('shell_user_id');
            // $table->text('shell_encuesta_id');
            // $table->text('shell_estatus_id');
            // $table->text('shell_fecha_fin');
            // $table->text('shell_fecha_corresponde');

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
        Schema::dropIfExists('encuesta_users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre_hotel');
            $table->string('Direccion');
            $table->string('Telefono');
            // $table->string('Pais');
            // $table->string('Estado');
            //Checar con gabo
            // $table->text('Vertical')->nullable();
            $table->text('dirlogo1')->nullable();
            $table->text('Fecha_inicioP')->nullable();
            $table->text('Fecha_terminoP')->nullable();
            $table->string('clave_geoestadistica')->nullable();

            $table->text('Latitude')->nullable();
            $table->text('Longitude')->nullable();
            $table->integer('RM')->nullable();
            $table->integer('ActivarCalificacion')->nullable();
            $table->integer('ActivarReportes')->nullable();
            $table->integer('ActivarDashboard')->nullable();

            //Primera llave foranea
            $table->integer('operaciones_id')->unsigned();
            $table->foreign('operaciones_id')->references('id')->on('operaciones');
            //Segunda llave foranea
            $table->integer('vertical_id')->unsigned();
            $table->foreign('vertical_id')->references('id')->on('verticals');
            //Tercera llave foranea
            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadenas');
            //Cuarta llave foranea
            $table->integer('servicios_id')->unsigned();
            $table->foreign('servicios_id')->references('id')->on('servicios');
            //Quinta llave foranea
            // $table->integer('proyectos_id')->unsigned();
            // $table->foreign('proyectos_id')->references('id')->on('proyectos');
            //Sexta llave foranea
            $table->integer('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('country_states');

            $table->text('id_proyecto')->nullable();
            //---------------------
            //---------------------
            // $table->binary('temp')->nullable();
            // $table->text('Responsable')->nullable();
            // $table->text('AreaTraSistemas')->nullable();
            // $table->text('TelefonoSistemas')->nullable();
            // $table->text('CorreoSistemas')->nullable();
            // $table->('itconcierges_id');
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
        Schema::dropIfExists('hotels');
    }
}

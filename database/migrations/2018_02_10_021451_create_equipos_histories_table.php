<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Equipo');
            $table->string('EquipoN');
            $table->string('MAC');
            $table->string('MACN');
            $table->string('Serie');
            $table->string('SerieN');
            $table->string('Modelo');
            $table->string('ModeloN');
            $table->string('Descripcion');
            $table->string('DescripcionN');
            $table->string('hotels_id');
            $table->string('hotels_idN');
            $table->string('proyectos_id');
            $table->string('proyectos_idN');
            $table->string('estados_id');
            $table->string('estados_idN');
            $table->string('servicios_id');
            $table->string('servicios_idN');
            $table->string('Nombre_Grupo');
            $table->string('Nombre_GrupoN');
            $table->string('Nombre_GrupoRecepcion');
            $table->string('Nombre_GrupoRecepcionN');
            $table->dateTime('fechamov');
            $table->string('Evento');
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
        Schema::dropIfExists('equipos_histories');
    }
}

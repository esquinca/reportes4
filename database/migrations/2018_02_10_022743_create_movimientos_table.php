<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('FechaMov');
            $table->string('Sujeto');
            $table->string('Motivo');
            $table->string('Equipo');
            $table->string('MAC');
            $table->string('Serie');
            $table->string('Descripcion');
            $table->string('OrigenHOTEL');
            $table->string('DestinoHOTEL');
            $table->string('Estado');
            $table->string('Grupo');
            $table->string('Proyecto');
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
        Schema::dropIfExists('movimientos');
    }
}

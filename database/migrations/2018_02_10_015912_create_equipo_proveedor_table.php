<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->bigInteger('equipo_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->string('No_Fact_Compra');
            $table->string('No_Fact_Venta');
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
        Schema::dropIfExists('equipo_proveedor');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('rfc');
            $table->string('direccion')->nullable();
            $table->string('regimen_Fiscal')->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('cp')->nullable();
            $table->string('telefono')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('agente_nombre')->nullable();
            $table->string('agente_telefono')->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}

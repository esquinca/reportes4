<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvBcoCtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prov_bco_ctas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prov_id')->unsigned();
            $table->foreign('prov_id')->references('id')->on('proveedors');

            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos');

            $table->string('cuenta');
            $table->string('clabe');
            $table->text('referencia')->nullable();

            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status_prov_bco_ctas');

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
        Schema::dropIfExists('prov_bco_ctas');
    }

}

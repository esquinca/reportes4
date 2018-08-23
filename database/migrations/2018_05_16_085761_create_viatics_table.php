<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViaticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viatics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            //1da llave foranea
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('viatic_services');
            //2ra llave foranea
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //3ta llave foranea
            $table->integer('jefedirecto_id')->unsigned();
            $table->foreign('jefedirecto_id')->references('id')->on('jefedirectos');
            //4ta llave foranea
            $table->integer('beneficiary_id')->unsigned();
            $table->foreign('beneficiary_id')->references('id')->on('viatic_beneficiaries');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('place_o');
            $table->string('place_d');
            $table->text('description')->nullable();
            //6ta llave foranea
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('viatic_states');

            $table->integer('priority_id')->unsigned();
            $table->foreign('priority_id')->references('id')->on('viatic_priorities');
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
        Schema::dropIfExists('viatics');
    }
}

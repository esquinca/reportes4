<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessnameContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessname_contracts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('contracts_id')->unsigned();
            $table->foreign('contracts_id')->references('id')->on('contracts');

            $table->integer('business_names_id')->unsigned();
            $table->foreign('business_names_id')->references('id')->on('business_names');

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
        Schema::dropIfExists('businessname_contracts');
    }
}

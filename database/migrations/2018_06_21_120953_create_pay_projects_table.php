<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_projects', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('verticals_id')->unsigned();
            $table->foreign('verticals_id')->references('id')->on('payments_verticals');

            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');

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
        Schema::dropIfExists('pay_projects');
    }
}

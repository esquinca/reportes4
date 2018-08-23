<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayFinancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_financings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('financings_id')->unsigned();
            $table->foreign('financings_id')->references('id')->on('payments_financings');

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
        Schema::dropIfExists('pay_financings');
    }
}

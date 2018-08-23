<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayStatusUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_status_users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('payments_states');

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
        Schema::dropIfExists('pay_status_users');
    }
}

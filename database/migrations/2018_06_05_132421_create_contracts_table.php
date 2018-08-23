<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_number');
            $table->date('date_in');
            $table->date('date_out');
            $table->integer('months');
            $table->integer('paid_months');
            $table->double('monthly_amount', 15, 8);
            $table->double('capex', 15, 8);
            $table->double('initial_investment', 15, 8);
            $table->double('initial_deposit', 15, 8);

            $table->integer('authorize_user_id')->unsigned();
            $table->foreign('authorize_user_id')->references('id')->on('users');

            $table->integer('contract_services_id')->unsigned();
            $table->foreign('contract_services_id')->references('id')->on('contract_services');

            $table->integer('contract_dates_id')->unsigned();
            $table->foreign('contract_dates_id')->references('id')->on('contract_dates');

            $table->integer('contract_acquisitions_id')->unsigned();
            $table->foreign('contract_acquisitions_id')->references('id')->on('contract_acquisitions');

            $table->integer('contract_payments_id')->unsigned();
            $table->foreign('contract_payments_id')->references('id')->on('contract_payments');

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
        Schema::dropIfExists('contracts');
    }
}

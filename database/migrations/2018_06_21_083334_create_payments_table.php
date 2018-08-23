<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
          $table->increments('id');
          $table->string('folio');
          $table->integer('cadena_id')->unsigned();
          $table->foreign('cadena_id')->references('id')->on('cadenas');

          $table->integer('hotel_id')->unsigned();
          $table->foreign('hotel_id')->references('id')->on('hotels');

          $table->integer('way_pay_id')->unsigned();
          $table->foreign('way_pay_id')->references('id')->on('payments_way_pays');

          $table->integer('applications_id')->unsigned();
          $table->foreign('applications_id')->references('id')->on('payments_applications');

          $table->integer('options_id')->unsigned();
          $table->foreign('options_id')->references('id')->on('payments_project_options');

          $table->integer('classification_id')->unsigned();
          $table->foreign('classification_id')->references('id')->on('payments_classifications');

          $table->integer('proveedor_id')->unsigned();
          $table->foreign('proveedor_id')->references('id')->on('proveedors');

          $table->string('name');
          $table->text('concept_pay')->nullable();
          $table->string('amount');

          $table->integer('currency_id')->unsigned();
          $table->foreign('currency_id')->references('id')->on('currencies');

          $table->integer('payments_states_id')->unsigned();
          $table->foreign('payments_states_id')->references('id')->on('payments_states');

          $table->date('date_solicitude');
          $table->date('date_pay')->nullable();

          $table->string('factura');
          $table->integer('prov_bco_ctas_id')->unsigned();
          $table->foreign('prov_bco_ctas_id')->references('id')->on('prov_bco_ctas');

          $table->integer('priority_id')->unsigned();
          $table->foreign('priority_id')->references('id')->on('payments_priorities');
                    
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
        Schema::dropIfExists('payments');
    }
}

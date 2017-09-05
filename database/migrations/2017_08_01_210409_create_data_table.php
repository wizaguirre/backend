<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {

            $table->increments('id');
            $table->date('date');
            $table->datetime('datetime');
            $table->integer('count');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');            

            $table->integer('gateway_id')->unsigned();
            $table->foreign('gateway_id')->references('id')->on('gateways');

            $table->integer('people_id')->unsigned();
            $table->foreign('people_id')->references('id')->on('people');          

            $table->softDeletes();
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
        Schema::dropIfExists('data');
    }
}

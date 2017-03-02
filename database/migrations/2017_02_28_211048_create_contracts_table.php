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
            $table->increments('CID');
            $table->integer('customerID');
            $table->string('startDest', 75);
            $table->string('finalDest', 75);
            $table->integer('distance')->nullable();
            $table->integer('type');
            $table->double('price', 15, 2)->nullable();
            $table->unsignedInteger('invoiceID');
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

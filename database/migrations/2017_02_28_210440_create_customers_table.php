<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('CID');
            $table->string('firstName', 20)->nullable();
            $table->string('lastname', 25)->nullable();
            $table->string('companyName', 30)->nullable();
            $table->string('companyIdentNr', 15)->nullable();
            $table->unsignedInteger('addressID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}

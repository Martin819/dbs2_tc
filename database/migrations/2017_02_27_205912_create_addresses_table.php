<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('AID');
            $table->string('streetName', 40);
            $table->string('houseNr', 9);
            $table->string('city', 35);
            $table->string('postalCode', 15)->nullable();
            $table->string('stateCODE', 2);
## INDEXES
#            $table->index('stateCODE');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

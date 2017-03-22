<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('VID');
            $table->integer('type');
            $table->string('maker', 15);
            $table->string('model', 15);
            $table->string('plateNumber', 8);
            $table->integer('litresPerKilometer');
            $table->unsignedInteger('homeBranchID')->nullable();
## INDEXES
            $table->index('homeBranchID');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('TID');
            $table->unsignedInteger('busLineID');
            $table->integer('dayOfWeek');
            $table->time('timeOfArrival');
            $table->unsignedInteger('busStopID');
            $table->unsignedInteger('busID');
## INDEXES
            $table->index('busLineID');
            $table->index('busStopID');
            $table->index('busID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}

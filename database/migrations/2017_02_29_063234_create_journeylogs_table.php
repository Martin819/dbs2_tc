<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneylogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeylogs', function (Blueprint $table) {
            $table->increments('JID');
            $table->unsignedInteger('employeeID')->nullable();
            $table->unsignedInteger('vehicleID')->nullable();
            $table->dateTime('dateTimeOfStart');
            $table->dateTime('dateTimeOfEnd');
##INDEXES
            $table->index(['vehicleID', 'dateTimeOfStart']);
            $table->index(['vehicleID', 'dateTimeOfEnd']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journeyLogs', function (Blueprint $table) {
            $table->dropIndex(['vehicleID', 'dateTimeOfStart']);
            $table->dropIndex(['vehicleID', 'dateTimeOfEnd']);
        });
        Schema::dropIfExists('journeylogs');
    }
}

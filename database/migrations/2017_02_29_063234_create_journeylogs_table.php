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
            $table->unsignedInteger('employeeID');
            $table->unsignedInteger('vehicleID');
            $table->date('dateOfStart');
            $table->time('timeOfStart');
            $table->date('dateOfEnd');
            $table->time('timeOfEnd');
            $table->time('duration');
##INDEXES
            $table->index(['vehicleID', 'dateOfStart']);
            $table->index(['vehicleID', 'dateOfEnd']);
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
            $table->dropIndex(['vehicleID', 'dateOfStart']);
            $table->dropIndex(['vehicleID', 'dateOfEnd']);
        });
        Schema::dropIfExists('journeylogs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingHoursLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workingHoursLogs', function (Blueprint $table) {
            $table->increments('WID');
            $table->integer('employeeID');
            $table->integer('typeOfAction');
            $table->date('dateOfAction');
            $table->time('timeOfAction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workingHoursLogs');
    }
}

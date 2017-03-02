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
            $table->unsignedInteger('employeeID');
            $table->integer('typeOfAction');
            $table->date('dateOfAction');
            $table->time('timeOfAction');
## INDEXES
            $table->index(['employeeID', 'dateOfAction']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workingHoursLogs', function (Blueprint $table) {
            $table->dropIndex(['employeeID', 'dateOfAction']);
        });
        Schema::dropIfExists('workingHoursLogs');
    }
}

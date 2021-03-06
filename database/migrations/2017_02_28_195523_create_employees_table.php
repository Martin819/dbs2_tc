<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('EID');
            $table->string('firstName', 20);
            $table->string('lastName', 25);
            $table->unsignedInteger('addressID')->nullable();
            $table->string('position', 40)->nullable();
            $table->date('dateHired')->nullable();
##INDEXES
            $table->index('addressID');
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

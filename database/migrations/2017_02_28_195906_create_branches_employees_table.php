<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_employees', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('branchID')->nullable();
            $table->unsignedInteger('employeeID');
            $table->boolean('isManager');
## INDEXES
            $table->index('branchID');
            $table->index('employeeID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches_employees');
    }
}

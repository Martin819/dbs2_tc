<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('stateCODE')->references('CODE')->on('statecodes');
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses');
            $table->foreign('managerID')->references('EID')->on('employees');
        });
        Schema::table('offices', function (Blueprint $table) {
            $table->foreign('BID')->references('BID')->on('branches');
        });
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreign('busLineID')->references('LID')->on('buslines');
            $table->foreign('busStopID')->references('SID')->on('busstops');
            $table->foreign('busID')->references('VID')->on('vehicles');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses');
            $table->foreign('branchID')->references('BID')->on('branches');
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('officeID')->references('BID')->on('offices');
        });
        Schema::table('depots', function (Blueprint $table) {
            $table->foreign('BID')->references('BID')->on('branches');
        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('homeBranchID')->references('BID')->on('branches');
        });
        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles');
        });
        Schema::table('trucks', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles');
        });
        Schema::table('buses', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles');
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees');
        });
        Schema::table('servicemen', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees');
        });
        Schema::table('management', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('invoiceID')->references('IID')->on('invoices');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('customerID')->references('CID')->on('customers');
            $table->foreign('contractID')->references('CID')->on('contracts');
        });
        Schema::table('workingHoursLogs', function (Blueprint $table) {
            $table->foreign('employeeID')->references('EID')->on('employees');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['stateCODE']);
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->dropForeign(['addressID']);
            $table->dropForeign(['managerID']);
        });
        Schema::table('offices', function (Blueprint $table) {
            $table->dropForeign(['BID']);
        });
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropForeign(['busLineID']);
            $table->dropForeign(['busStopID']);
            $table->dropForeign(['busID']);
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['addressID']);
            $table->dropForeign(['branchID']);
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['officeID']);
        });
        Schema::table('depots', function (Blueprint $table) {
            $table->dropForeign(['BID']);
        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['homeBranchID']);
        });
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['VID']);
        });
        Schema::table('buses', function (Blueprint $table) {
            $table->dropForeign(['VID']);
        });
        Schema::table('trucks', function (Blueprint $table) {
            $table->dropForeign(['VID']);
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropForeign(['EID']);
        });
        Schema::table('servicemen', function (Blueprint $table) {
            $table->dropForeign(['EID']);
        });
        Schema::table('management', function (Blueprint $table) {
            $table->dropForeign(['EID']);
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['addressID']);
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['invoiceID']);
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['customerID']);
            $table->dropForeign(['contractID']);
        });
        Schema::table('workingHoursLogs', function (Blueprint $table) {
            $table->dropForeign(['employeeID']);
        });
    }
}

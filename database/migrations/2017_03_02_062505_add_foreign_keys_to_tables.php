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
            $table->foreign('stateCODE')->references('CODE')->on('statecodes')->onDelete('restrict')->onUpdate('cascade');
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('offices', function (Blueprint $table) {
            $table->foreign('BID')->references('BID')->on('branches')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreign('busLineID')->references('LID')->on('buslines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('busStopID')->references('SID')->on('busstops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('busID')->references('VID')->on('vehicles')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('branches_employees', function (Blueprint $table) {
            $table->foreign('employeeID')->references('EID')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('branchID')->references('BID')->on('branches')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('officeID')->references('BID')->on('offices')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('depots', function (Blueprint $table) {
            $table->foreign('BID')->references('BID')->on('branches')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('warehouses', function (Blueprint $table) {
            $table->foreign('BID')->references('BID')->on('branches')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('homeBranchID')->references('BID')->on('branches')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('trucks', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('buses', function (Blueprint $table) {
            $table->foreign('VID')->references('VID')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('servicemen', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('management', function (Blueprint $table) {
            $table->foreign('EID')->references('EID')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('addressID')->references('AID')->on('addresses')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('customerID')->references('CID')->on('customers')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('customerID')->references('CID')->on('customers')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('contracts_invoices', function (Blueprint $table) {
            $table->foreign('invoiceID')->references('IID')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('contractID')->references('CID')->on('contracts')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('workingHoursLogs', function (Blueprint $table) {
            $table->foreign('employeeID')->references('EID')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('journeyLogs', function (Blueprint $table) {
            $table->foreign('employeeID')->references('EID')->on('employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('vehicleID')->references('VID')->on('vehicles')->onDelete('set null')->onUpdate('cascade');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        });
        Schema::table('branches_employees', function (Blueprint $table) {
            $table->dropForeign(['employeeID']);
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
            $table->dropForeign(['customerID']);
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['customerID']);
        });
        Schema::table('contracts_invoices', function (Blueprint $table) {
            $table->dropForeign(['invoiceID']);
            $table->dropForeign(['contractID']);
        });
        Schema::table('workingHoursLogs', function (Blueprint $table) {
            $table->dropForeign(['employeeID']);
        });
        Schema::table('journeyLogs', function (Blueprint $table) {
            $table->dropForeign(['employeeID']);
            $table->dropForeign(['vehicleID']);
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['id']);
        });
    }
}

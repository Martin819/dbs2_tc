<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_invoices', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('contractID');
            $table->unsignedInteger('invoiceID')->nullable();
## INDEXES
            $table->index('contractID');
            $table->index('invoiceID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts_invoices');
    }
}

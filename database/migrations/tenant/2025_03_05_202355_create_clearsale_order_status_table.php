<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsaleOrderStatusTable.
 *
 * Creates the 'clearsale_order_status' table to record status and risk scores returned by ClearSale.
 *
 * The 'status' field uses an ENUM with the following mapping:
 *   APA: Automatic Approval
 *   APM: Manual Approval
 *   RPM: Declined (Manual Decline)
 *   AMA: Manual Analysis
 *   ERR: Error during integration
 *   NVO: New Order
 *   SUS: Fraud Suspicion
 *   CAN: Customer Asked for Cancellation
 *   FRD: Confirmed Fraud
 *   RPA: Automatically Declined
 *   RPP: Denied by Policy
 *   APG: Awaiting Payment
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsaleOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_order_status', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key reference to the clearsale_orders table.
            $table->foreignId('clearsale_order_id')->comment('Reference to the order in the clearsale_orders table');

            $table->enum('status', ['APA', 'APM', 'RPM', 'AMA', 'ERR', 'NVO', 'SUS', 'CAN', 'FRD', 'RPA', 'RPP', 'APG'])
                  ->comment('ClearSale status code (e.g., APA=Automatic Approval, APM=Manual Approval, RPM=Declined, AMA=Manual Analysis, ERR=Error, NVO=New Order, SUS=Fraud Suspicion, CAN=Customer Cancellation, FRD=Confirmed Fraud, RPA=Automatically Declined, RPP=Denied by Policy, APG=Awaiting Payment)');

            $table->string('score')->nullable()->comment('Risk score assigned by ClearSale, if available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('clearsale_order_status');
    }
}

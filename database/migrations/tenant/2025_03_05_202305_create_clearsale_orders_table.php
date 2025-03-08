<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsaleOrdersTable.
 *
 * Creates the 'clearsale_orders' table to store order data submitted to ClearSale for fraud analysis.
 *
 * Fields:
 * - total_items, total_order, total_shipping: DECIMAL(20,4) for high monetary precision.
 * - currency: Limited to 3 characters to match ISO 4217 currency codes (e.g., BRL, USD).
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            $table->string('order_id')->comment('Internal order identifier');
            $table->string('clearsale_order_id')->nullable()->comment('Order identifier returned by ClearSale, if applicable');
            $table->timestamp('date')->comment('Date and time of the order sent for analysis');
            $table->string('email', 150)->comment('Customer email associated with the order');

            // Monetary fields with high precision.
            $table->decimal('total_items', 20, 4)->comment('Total value of the items');
            $table->decimal('total_order', 20, 4)->comment('Total order value (items + additional charges)');
            $table->decimal('total_shipping', 20, 4)->nullable()->comment('Shipping cost, if applicable');

            $table->string('currency', 3)->nullable()->comment('Currency code (ISO 4217), e.g., BRL, USD');
            $table->string('ip', 50)->comment('IP address from which the order originated');
            $table->string('origin', 150)->comment('Origin of the order (e.g., Mobile, Web)');
            $table->string('session_id', 200)->comment('Session ID associated with the order');
            $table->boolean('reanalysis')->default(false)->comment('Indicates if the order is a reanalysis of a previously submitted order');

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
        Schema::dropIfExists('clearsale_orders');
    }
}

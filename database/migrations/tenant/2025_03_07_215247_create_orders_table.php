<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateOrdersTable.
 *
 * This migration creates the 'orders' table for storing checkout orders.
 * Fields:
 * - user_id: References the user placing the order.
 * - total: The total order amount stored as DECIMAL(20,4) for high precision.
 * - status: The order status (e.g., pending, paid, failed).
 * - payment_id: The payment transaction ID from Pagar.me (nullable).
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.
            $table->foreignId('customer_id')->comment('Reference to the customer placing the order');
            $table->decimal('total', 20, 4)->comment('Total order amount in the smallest currency unit with 4 decimal places');
            $table->string('status', 50)->comment('Order status (e.g., pending, paid, failed)');
            $table->string('payment_id')->nullable()->comment('Payment transaction ID from Pagar.me');
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
        Schema::dropIfExists('orders');
    }
}

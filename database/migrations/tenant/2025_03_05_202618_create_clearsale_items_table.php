<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsaleItemsTable.
 *
 * Creates the 'clearsale_items' table to store order item data for ClearSale analysis.
 *
 * Fields:
 * - price: DECIMAL(20,4) to store the unit price with high precision.
 * - product_id: Limited to 50 characters.
 * - product_title: Limited to 150 characters.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_items', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key to clearsale_orders.
            $table->foreignId('clearsale_order_id')->comment('Reference to the order in clearsale_orders');

            $table->string('product_id', 50)->comment('Product identifier');
            $table->string('product_title', 150)->comment('Product title or name');

            // Unit price of the product.
            $table->decimal('price', 20, 4)->comment('Unit price with 4 decimal places of precision');

            $table->integer('quantity')->comment('Quantity of the product purchased');
            $table->string('category', 200)->nullable()->comment('Product category or classification');

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
        Schema::dropIfExists('clearsale_items');
    }
}

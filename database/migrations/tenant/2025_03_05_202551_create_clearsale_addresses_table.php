<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsaleAddressesTable.
 *
 * Creates the 'clearsale_addresses' table to store addresses associated with orders
 * sent for ClearSale analysis.
 *
 * Fields:
 * - address_line1: Primary address information (street, number, neighborhood).
 * - state: Limited to 2 characters to follow ISO state codes (e.g., "CA", "RJ").
 * - zip_code: Up to 10 characters to support various international postal formats.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsaleAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_addresses', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key to clearsale_orders.
            $table->foreignId('clearsale_order_id')->comment('Reference to the order in clearsale_orders');

            $table->string('address_line1', 250)->nullable()->comment('Address line 1: street, number, and neighborhood');
            $table->string('address_line2', 250)->nullable()->comment('Address line 2: additional information or reference');
            $table->string('city', 150)->comment('City');
            $table->string('state', 2)->comment('State code (2 characters, e.g., "CA")');
            $table->string('zip_code', 10)->comment('Postal code (supports various international formats)');
            $table->string('country', 150)->nullable()->comment('Country (name or code)');

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
        Schema::dropIfExists('clearsale_addresses');
    }
}

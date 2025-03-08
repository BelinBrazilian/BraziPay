<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsaleCustomFieldsTable.
 *
 * Creates the 'clearsale_custom_fields' table to store custom (key-value) fields
 * submitted along with the order to ClearSale.
 *
 * This allows for flexible storage of additional metadata.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsaleCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_custom_fields', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key to clearsale_orders.
            $table->foreignId('clearsale_order_id')->comment('Reference to the order in clearsale_orders');

            $table->string('name', 500)->comment('Custom field name');
            $table->string('value', 1000)->comment('Custom field value');
            $table->integer('type')->nullable()->comment('Numeric code representing the type of custom field, if applicable');

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
        Schema::dropIfExists('clearsale_custom_fields');
    }
}

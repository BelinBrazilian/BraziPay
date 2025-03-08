<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreatePagarmeCardsTable.
 *
 * Creates the 'pagarme_cards' table to store tokenized card information associated with customers.
 * This table avoids storing sensitive card details, keeping only non-critical data.
 *
 * Fields:
 * - last_four: Last 4 digits of the card number.
 * - brand: The card brand (e.g., Visa, Mastercard).
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreatePagarmeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pagarme_cards', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key reference to the customers table.
            $table->foreignId('customer_id')->comment('Reference to the customer who owns the card');

            // Unique card ID returned by the API.
            $table->string('card_id')->unique()->comment('Unique card identifier returned by the API');

            // Last four digits of the card.
            $table->string('last_four', 4)->comment('Last 4 digits of the card number');

            // Card brand (e.g., Visa, Mastercard).
            $table->string('brand')->comment('Card brand (e.g., Visa, Mastercard)');

            // Optional card token.
            $table->string('token')->nullable()->comment('Card token, if available, for secure transactions');

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
        Schema::dropIfExists('pagarme_cards');
    }
}

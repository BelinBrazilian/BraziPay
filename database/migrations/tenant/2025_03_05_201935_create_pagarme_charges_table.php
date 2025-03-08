<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreatePagarmeChargesTable.
 *
 * Creates the 'pagarme_charges' table to store charge data from the Pagar.me API.
 *
 * Fields:
 * - amount: DECIMAL(20,4) for monetary precision.
 * - status: ENUM with allowed values: pending, paid, canceled, processing, failed, overpaid, underpaid, chargedback.
 *   (For example, "chargedback" indicates that a chargeback has occurred.)
 * - payment_method: ENUM with allowed values: credit_card, boleto, pix, voucher, bank_transfer,
 *   safetypay, checkout, cash, private_label, debit_card.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreatePagarmeChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pagarme_charges', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key reference to the orders table.
            $table->foreignId('order_id')->comment('Reference to the order in the orders table');

            // Unique charge ID returned by the Pagar.me API.
            $table->string('charge_id')->unique()->comment('Unique charge ID returned by the Pagar.me API');

            // Monetary amount in the smallest currency unit (e.g., cents).
            $table->decimal('amount', 20, 4)->comment('Charge amount in the smallest currency unit with 4 decimal places');

            // Charge status as returned by the API.
            $table->enum('status', ['pending', 'paid', 'canceled', 'processing', 'failed', 'overpaid', 'underpaid', 'chargedback'])
                  ->comment('Charge status (e.g., pending, paid, canceled, processing, failed, overpaid, underpaid, chargedback)');

            // Payment method used.
            $table->enum('payment_method', [
                'credit_card',
                'boleto',
                'pix',
                'voucher',
                'bank_transfer',
                'safetypay',
                'checkout',
                'cash',
                'private_label',
                'debit_card'
            ])->comment('Payment method used (e.g., credit_card, boleto, pix, voucher, bank_transfer, safetypay, checkout, cash, private_label, debit_card)');

            // Optional gateway-specific identifier.
            $table->string('gateway_id')->nullable()->comment('Gateway-specific identifier, if applicable');

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
        Schema::dropIfExists('pagarme_charges');
    }
}

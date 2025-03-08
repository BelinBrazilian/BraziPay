<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateClearsalePaymentsTable.
 *
 * Creates the 'clearsale_payments' table to store payment data submitted to ClearSale for fraud analysis.
 *
 * Fields:
 * - amount: DECIMAL(20,4) for monetary values.
 * - card_type: Integer mapping to ClearSale's card type (see mapping below).
 * - type: Integer mapping to ClearSale Payment Method (see mapping below).
 *
 * Payment Method (ClearSale) Mapping:
 *   1: CREDIT CARD
 *   2: PAYMENT SLIP
 *   3: DIRECT DEBIT
 *   4: AMAZON PAYMENTS
 *   5: BITCOIN
 *   6: BANK TRANSFER
 *   7: APPLE PAY
 *   8: CHECK
 *   9: CASH
 *   10: FINANCING
 *   11: INVOICE
 *   12: COUPON
 *   13: PAYPAL
 *   14: OTHER
 *   15: ALIPAY
 *   16: GOOGLE PAY
 *   17: WALLET
 *   18: GIFTCARD
 *   19: VIRTUAL CREDIT CARD
 *
 * Card Type (ClearSale) Mapping:
 *   1: Diners
 *   2: MasterCard
 *   3: Visa
 *   4: Others
 *   5: American Express
 *   6: HiperCard
 *   7: Aura
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateClearsalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clearsale_payments', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // Foreign key reference to clearsale_orders.
            $table->foreignId('clearsale_order_id')->comment('Reference to the associated order in clearsale_orders');

            // Date of the payment submission.
            $table->date('payment_date')->comment('Payment date submitted for fraud analysis');

            // Numeric code representing the card type (1 = Diners, 2 = MasterCard, 3 = Visa, etc.).
            $table->integer('card_type')->nullable()->comment('Numeric code for card type (1: Diners, 2: MasterCard, 3: Visa, 4: Others, 5: American Express, 6: HiperCard, 7: Aura)');

            // Card expiration date (format can be MM/YY or MM/YYYY).
            $table->string('card_expiration_date')->nullable()->comment('Card expiration date (e.g., MM/YY or MM/YYYY)');

            // Numeric code for payment method as per ClearSale's enum.
            $table->integer('type')->comment('Numeric code for payment method (see Payment Method mapping above)');

            $table->string('card_holder_name', 150)->nullable()->comment('Name of the cardholder');
            $table->string('card_end_number', 4)->nullable()->comment('Last 4 digits of the card');
            $table->string('card_bin', 6)->nullable()->comment('Card BIN (first 6 digits)');

            // Monetary amount of the payment.
            $table->decimal('amount', 20, 4)->comment('Payment amount in the smallest currency unit with 4 decimal places');

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
        Schema::dropIfExists('clearsale_payments');
    }
}

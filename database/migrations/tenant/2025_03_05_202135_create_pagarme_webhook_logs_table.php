<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreatePagarmeWebhookLogsTable.
 *
 * Creates the 'pagarme_webhook_logs' table to store webhook payloads received from Pagar.me.
 *
 * Fields:
 * - payload: JSON field containing the webhook data.
 * - received_at: Timestamp for when the webhook was received.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreatePagarmeWebhookLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pagarme_webhook_logs', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.

            // JSON payload received from the webhook.
            $table->json('payload')->comment('JSON payload received from the Pagar.me webhook');

            // Timestamp when the webhook was received.
            $table->timestamp('received_at')->useCurrent()->comment('Timestamp of webhook receipt');

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
        Schema::dropIfExists('pagarme_webhook_logs');
    }
}

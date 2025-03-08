<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: UpdateTenantsTableAddCustomColumns.
 *
 * This migration updates the tenants table by adding custom columns that store essential tenant configuration.
 *
 * The following columns are added:
 * - name: The name of the tenant (e.g., store name).
 * - plan: The subscription plan of the tenant (e.g., free, premium).
 * - currency: The default currency for the tenant (ISO 4217 code, e.g., BRL, USD).
 * - filament_theme: The theme used in the Filament admin panel.
 * - pagarme_api_key: The API key for Pagar.me integration.
 * - clearsale_api_key: The API key for ClearSale integration.
 *
 * Exposing these attributes in dedicated columns (instead of solely in the JSON "data" field)
 * improves clarity, query performance, and validation according to domain rules.
 *
 * @see https://tenancyforlaravel.com/docs/v3/tenants
 */
class UpdateTenantsTableAddCustomColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Add a column for the tenant's name.
            $table->string('name', 150)
                  ->after('id')
                  ->comment('Name of the tenant (store name)');

            // Add a column for the tenant's subscription plan.
            $table->string('plan', 50)
                  ->after('name')
                  ->comment('Subscription plan (e.g., free, premium)');

            // Add a column for the default currency (ISO 4217 code).
            $table->string('currency', 3)
                  ->after('plan')
                  ->default('BRL')
                  ->comment('Default currency code (ISO 4217, e.g., BRL, USD)');

            // Add a column for the Filament theme configuration.
            $table->string('filament_theme', 50)
                  ->after('currency')
                  ->default('default')
                  ->comment('Theme for the Filament admin panel');

            // Add columns for integration API keys.
            $table->string('pagarme_api_key', 100)
                  ->nullable()
                  ->after('filament_theme')
                  ->comment('API key for Pagar.me integration');
            $table->string('clearsale_api_key', 100)
                  ->nullable()
                  ->after('pagarme_api_key')
                  ->comment('API key for ClearSale integration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                                   'name',
                                   'plan',
                                   'currency',
                                   'filament_theme',
                                   'pagarme_api_key',
                                   'clearsale_api_key',
                               ]);
        });
    }
}

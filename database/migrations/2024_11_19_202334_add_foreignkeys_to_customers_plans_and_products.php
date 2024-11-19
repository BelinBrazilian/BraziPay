<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to add foreign keys to existing tables.
     *
     * This migration adds foreign key constraints to the 'customers', 'phones',
     * 'plan_items', and 'pricing_ranges' tables, ensuring referential integrity
     * by linking them to related tables. Each constraint is added only if it
     * does not already exist.
     *
     * @return void
     */
    public function up(): void
    {
        // Add foreign key for 'address_id' in 'customers' table
        if (Schema::hasTable('customers') && Schema::hasTable('addresses')) {
            Schema::table('customers', function (Blueprint $table) {
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'customers_address_id_foreign'")) {
                    $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
                }
            });
        }

        // Add foreign key for 'customer_id' in 'phones' table
        if (Schema::hasTable('phones') && Schema::hasTable('customers')) {
            Schema::table('phones', function (Blueprint $table) {
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'phones_customer_id_foreign'")) {
                    $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
                }
            });
        }

        // Add foreign keys in 'plan_items' for 'plan_id', 'product_id', and 'pricing_schema_id'
        if (Schema::hasTable('plan_items') && Schema::hasTable('plans') && Schema::hasTable('products') && Schema::hasTable('pricing_schemas')) {
            Schema::table('plan_items', function (Blueprint $table) {
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'plan_items_plan_id_foreign'")) {
                    $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
                }
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'plan_items_product_id_foreign'")) {
                    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                }
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'plan_items_pricing_schema_id_foreign'")) {
                    $table->foreign('pricing_schema_id')->references('id')->on('pricing_schemas')->onDelete('cascade');
                }
            });
        }

        // Add foreign key for 'pricing_schema_id' in 'pricing_ranges' table
        if (Schema::hasTable('pricing_ranges') && Schema::hasTable('pricing_schemas')) {
            Schema::table('pricing_ranges', function (Blueprint $table) {
                if (!DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'pricing_ranges_pricing_schema_id_foreign'")) {
                    $table->foreign('pricing_schema_id')->references('id')->on('pricing_schemas')->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations by dropping the foreign keys.
     *
     * This method removes the foreign key constraints from the 'customers',
     * 'phones', 'plan_items', and 'pricing_ranges' tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });

        Schema::table('phones', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::table('plan_items', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['pricing_schema_id']);
        });

        Schema::table('pricing_ranges', function (Blueprint $table) {
            $table->dropForeign(['pricing_schema_id']);
        });
    }
};

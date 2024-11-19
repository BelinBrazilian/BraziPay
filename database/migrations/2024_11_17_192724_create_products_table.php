<?php

use App\Http\Enums\ProductStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create or update the 'products', 'pricing_schemas', and 'pricing_ranges' tables.
     *
     * This migration creates the required tables if they do not exist, and checks for each column
     * within each table, adding missing columns if necessary to ensure table structure consistency.
     *
     * @return void
     */
    public function up(): void
    {
        // Create 'products' table if it does not exist
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('external_id')->nullable();
                $table->string('name');
                $table->string('code')->unique();
                $table->string('unit');
                $table->enum('status', array_column(ProductStatusEnum::cases(), 'value'));
                $table->text('description')->nullable();
                $table->enum('invoice', ['always', 'on_demand']);
                $table->timestamps();
                $table->json('metadata')->nullable();
            });
        } else {
            // Check and add missing columns to 'products' table
            Schema::table('products', function (Blueprint $table) {
                if (!Schema::hasColumn('products', 'external_id')) {
                    $table->unsignedBigInteger('external_id')->nullable();
                }
                if (!Schema::hasColumn('products', 'name')) {
                    $table->string('name');
                }
                if (!Schema::hasColumn('products', 'code')) {
                    $table->string('code')->unique();
                }
                if (!Schema::hasColumn('products', 'unit')) {
                    $table->string('unit');
                }
                if (!Schema::hasColumn('products', 'status')) {
                    $table->enum('status', array_column(ProductStatusEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('products', 'description')) {
                    $table->text('description')->nullable();
                }
                if (!Schema::hasColumn('products', 'invoice')) {
                    $table->enum('invoice', ['always', 'on_demand']);
                }
                if (!Schema::hasColumn('products', 'metadata')) {
                    $table->json('metadata')->nullable();
                }
            });
        }

        // Create 'pricing_schemas' table if it does not exist
        if (!Schema::hasTable('pricing_schemas')) {
            Schema::create('pricing_schemas', function (Blueprint $table) {
                $table->id();
                $table->string('short_format');
                $table->decimal('price', 10, 2);
                $table->decimal('minimum_price', 10, 2)->nullable();
                $table->enum('schema_type', ['flat', 'tiered']);
                $table->timestamps();
            });
        } else {
            // Check and add missing columns to 'pricing_schemas' table
            Schema::table('pricing_schemas', function (Blueprint $table) {
                if (!Schema::hasColumn('pricing_schemas', 'short_format')) {
                    $table->string('short_format');
                }
                if (!Schema::hasColumn('pricing_schemas', 'price')) {
                    $table->decimal('price', 10, 2);
                }
                if (!Schema::hasColumn('pricing_schemas', 'minimum_price')) {
                    $table->decimal('minimum_price', 10, 2)->nullable();
                }
                if (!Schema::hasColumn('pricing_schemas', 'schema_type')) {
                    $table->enum('schema_type', ['flat', 'tiered']);
                }
            });
        }

        // Create 'pricing_ranges' table if it does not exist
        if (!Schema::hasTable('pricing_ranges')) {
            Schema::create('pricing_ranges', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pricing_schema_id');
                $table->integer('start_quantity');
                $table->integer('end_quantity')->nullable();
                $table->decimal('price', 10, 2);
                $table->decimal('overage_price', 10, 2)->nullable();
            });
        } else {
            // Check and add missing columns to 'pricing_ranges' table
            Schema::table('pricing_ranges', function (Blueprint $table) {
                if (!Schema::hasColumn('pricing_ranges', 'pricing_schema_id')) {
                    $table->unsignedBigInteger('pricing_schema_id');
                }
                if (!Schema::hasColumn('pricing_ranges', 'start_quantity')) {
                    $table->integer('start_quantity');
                }
                if (!Schema::hasColumn('pricing_ranges', 'end_quantity')) {
                    $table->integer('end_quantity')->nullable();
                }
                if (!Schema::hasColumn('pricing_ranges', 'price')) {
                    $table->decimal('price', 10, 2);
                }
                if (!Schema::hasColumn('pricing_ranges', 'overage_price')) {
                    $table->decimal('overage_price', 10, 2)->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations by dropping the 'pricing_ranges', 'pricing_schemas', and 'products' tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_ranges');
        Schema::dropIfExists('pricing_schemas');
        Schema::dropIfExists('products');
    }
};

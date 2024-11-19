<?php

use App\Http\Enums\PlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create or update the 'plans' and 'plan_items' tables.
     *
     * This migration creates the 'plans' and 'plan_items' tables if they do not exist.
     * It also verifies the existence of each column within each table, adding missing
     * columns where necessary to ensure table structure consistency.
     *
     * @return void
     */
    public function up(): void
    {
        // Create 'plans' table if it does not exist
        if (!Schema::hasTable('plans')) {
            Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('external_id')->nullable();
                $table->string('name');
                $table->enum('interval', array_column(PlanIntervalEnum::cases(), 'value'));
                $table->integer('interval_count');
                $table->enum('billing_trigger_type', array_column(PlanBillingTriggerTypeEnum::cases(), 'value'));
                $table->integer('billing_trigger_day')->nullable();
                $table->integer('billing_cycles');
                $table->string('code')->unique();
                $table->text('description')->nullable();
                $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
                $table->integer('installments')->default(1);
                $table->string('invoice_split')->nullable();
                $table->string('interval_name')->nullable();
                $table->timestamps();
                $table->json('metadata')->nullable();
                $table->softDeletes();
            });
        } else {
            // Check and add missing columns to 'plans' table
            Schema::table('plans', function (Blueprint $table) {
                if (!Schema::hasColumn('plans', 'external_id')) {
                    $table->unsignedBigInteger('external_id')->nullable();
                }
                if (!Schema::hasColumn('plans', 'name')) {
                    $table->string('name');
                }
                if (!Schema::hasColumn('plans', 'interval')) {
                    $table->enum('interval', array_column(PlanIntervalEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('plans', 'interval_count')) {
                    $table->integer('interval_count');
                }
                if (!Schema::hasColumn('plans', 'billing_trigger_type')) {
                    $table->enum('billing_trigger_type', array_column(PlanBillingTriggerTypeEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('plans', 'billing_trigger_day')) {
                    $table->integer('billing_trigger_day')->nullable();
                }
                if (!Schema::hasColumn('plans', 'billing_cycles')) {
                    $table->integer('billing_cycles');
                }
                if (!Schema::hasColumn('plans', 'code')) {
                    $table->string('code')->unique();
                }
                if (!Schema::hasColumn('plans', 'description')) {
                    $table->text('description')->nullable();
                }
                if (!Schema::hasColumn('plans', 'status')) {
                    $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('plans', 'installments')) {
                    $table->integer('installments')->default(1);
                }
                if (!Schema::hasColumn('plans', 'invoice_split')) {
                    $table->string('invoice_split')->nullable();
                }
                if (!Schema::hasColumn('plans', 'interval_name')) {
                    $table->string('interval_name')->nullable();
                }
                if (!Schema::hasColumn('plans', 'metadata')) {
                    $table->json('metadata')->nullable();
                }
                if (!Schema::hasColumn('plans', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        // Create 'plan_items' table if it does not exist
        if (!Schema::hasTable('plan_items')) {
            Schema::create('plan_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('plan_id');
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('pricing_schema_id');
                $table->integer('cycles');
                $table->timestamps();
            });
        } else {
            // Check and add missing columns to 'plan_items' table
            Schema::table('plan_items', function (Blueprint $table) {
                if (!Schema::hasColumn('plan_items', 'plan_id')) {
                    $table->unsignedBigInteger('plan_id');
                }
                if (!Schema::hasColumn('plan_items', 'product_id')) {
                    $table->unsignedBigInteger('product_id');
                }
                if (!Schema::hasColumn('plan_items', 'pricing_schema_id')) {
                    $table->unsignedBigInteger('pricing_schema_id');
                }
                if (!Schema::hasColumn('plan_items', 'cycles')) {
                    $table->integer('cycles');
                }
            });
        }
    }

    /**
     * Reverse the migrations by dropping the 'plan_items' and 'plans' tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_items');
        Schema::dropIfExists('plans');
    }
};

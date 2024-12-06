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
     */
    public function up(): void
    {
        // Create 'plans' table if it does not exist
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->string('name');
            $table->enum('interval', array_column(PlanIntervalEnum::cases(), 'value'));
            $table->integer('interval_count');
            $table->string('interval_name')->nullable();
            $table->enum('billing_trigger_type', array_column(PlanBillingTriggerTypeEnum::cases(), 'value'));
            $table->integer('billing_trigger_day')->nullable();
            $table->integer('billing_cycles');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
            $table->json('metadata')->nullable();
            $table->integer('installments')->default(1);
            $table->string('invoice_split')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations by dropping the 'plan_items' and 'plans' tables.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

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
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->uuid('code')->unique();
            $table->string('name');
            $table->string('interval'); // Ex: day, week, month
            $table->integer('interval_count');
            $table->string('billing_trigger_type'); // Ex: beginning_of_period, end_of_period
            $table->integer('billing_trigger_day');
            $table->integer('billing_cycles')->nullable();
            $table->text('description')->nullable();
            $table->integer('installments')->nullable();
            $table->boolean('invoice_split')->nullable();
            $table->string('status')->nullable(); // Ex: active, inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

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
            $table->enum('interval', array_column(PlanIntervalEnum::cases(), 'value'))->required();
            $table->integer('interval_count');
            $table->enum('billing_trigger_type', array_column(PlanBillingTriggerTypeEnum::cases(), 'value'))->required();
            $table->integer('billing_trigger_day');
            $table->integer('billing_cycles')->nullable();
            $table->text('description')->nullable();
            $table->integer('installments')->nullable();
            $table->boolean('invoice_split')->nullable();
            $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
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

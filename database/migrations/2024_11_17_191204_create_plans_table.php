<?php

use App\Http\Enums\PlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->string('name')->required();
            $table->enum('interval', array_column(PlanIntervalEnum::cases(), 'value'))->required();
            $table->integer('interval_count')->required();
            $table->enum('billing_trigger_type', array_column(PlanBillingTriggerTypeEnum::cases(), 'value'))->required();
            $table->integer('billing_trigger_day')->required();
            $table->integer('billing_cycles')->nullable();
            $table->uuid('code')->unique();
            $table->text('description')->nullable();
            $table->integer('installments')->default(1);
            $table->string('invoice_split')->nullable();
            $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('pricing_ranges', function (Blueprint $table) { 
            $table->id();
            $table->integer('start_quantity');
            $table->integer('end_quantity');
            $table->float('price');
            $table->float('overage_price');
        });

        Schema::create('pricing_schema', function (Blueprint $table) {
            $table->id();
            $table->string('short_format')->nullable();
            $table->float('price');
            $table->float('minimum_price');
            $table->string('schema_type');
            $table->unsignedBigInteger('pricing_range_id');
            $table->timestamps();

            $table->foreign('pricing_range_id')->references('id')->on('pricing_ranges')->onDelete('cascade');
        });

        Schema::create('plan_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('pricing_schema_id');
            $table->integer('cycles');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('pricing_schema_id')->references('id')->on('pricing_schema')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_items');
        Schema::dropIfExists('pricing_schema');
        Schema::dropIfExists('pricing_ranges');
        Schema::dropIfExists('plans');
    }
};

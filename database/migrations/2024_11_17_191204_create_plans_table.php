<?php

use App\Http\Enums\PlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() { 
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
        
        Schema::create('plan_items', function (Blueprint $table) { $table->id(); 
            $table->unsignedBigInteger('plan_id'); 
            $table->unsignedBigInteger('product_id'); 
            $table->unsignedBigInteger('pricing_schema_id'); 
            $table->integer('cycles'); 
            $table->timestamps(); 
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade'); 
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
            $table->foreign('pricing_schema_id')->references('id')->on('pricing_schemas')->onDelete('cascade'); 
        }); 
    } 
    
    public function down() { 
        Schema::dropIfExists('plan_items'); 
        Schema::dropIfExists('plans'); 
    }
};

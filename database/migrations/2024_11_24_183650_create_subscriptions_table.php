<?php

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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('external_id')->nullable();
            $table->uuid('code')->unique();
            $table->timestamp('start_at')->nullable();
            $table->integer('installments')->nullable();
            $table->string('billing_trigger_type')->nullable();
            $table->integer('billing_trigger_day')->nullable();
            $table->integer('billing_cycles')->nullable();
            $table->boolean('invoice_split')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

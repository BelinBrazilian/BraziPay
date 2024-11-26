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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_profile_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('payment_condition_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('external_id')->nullable();
            $table->uuid('code')->unique();
            $table->integer('installments')->nullable();
            $table->timestamp('billing_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->string('brand_tid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};

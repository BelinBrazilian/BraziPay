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
        Schema::create('payment_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('token')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('registry_code')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('card_expiration')->nullable();
            $table->boolean('allow_as_fallback')->default(false);
            $table->string('card_number')->nullable();
            $table->string('card_cvv')->nullable();
            $table->string('card_token')->nullable();
            $table->string('gateway_id')->nullable();
            $table->string('payment_method_code')->nullable();
            $table->string('payment_company_code')->nullable();
            $table->string('gateway_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_profiles');
    }
};

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
        Schema::create('payment_conditions', function (Blueprint $table) {
            $table->id();
            $table->decimal('penalty_fee_value', 10, 2)->nullable();
            $table->string('penalty_fee_type')->nullable(); // Ex: percentage, fixed
            $table->decimal('daily_fee_value', 10, 2)->nullable();
            $table->string('daily_fee_type')->nullable(); // Ex: percentage, fixed
            $table->integer('after_due_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_conditions');
    }
};

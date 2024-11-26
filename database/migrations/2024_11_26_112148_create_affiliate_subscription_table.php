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
        Schema::create('affiliate_subscription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->decimal('ammount', 10, 2);
            $table->enum('amount_type', [1, 2]);
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->string('remove')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_subscription');
    }
};

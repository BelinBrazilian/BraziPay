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
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->timestamp('billing_at');
            $table->integer('cycle');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->integer('duration'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->foreignId('product_item_id')->constrained()->onDelete('cascade');
            $table->string('discount_type');
            $table->decimal('percentage', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('cycles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};

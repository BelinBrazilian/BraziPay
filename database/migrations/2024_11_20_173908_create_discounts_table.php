<?php

use App\Http\Enums\DiscountTypeEnum;
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
            $table->unsignedBigInteger('product_item_id');
            $table->enum('discount_type', array_column(DiscountTypeEnum::cases(), 'value'));
            $table->float('percentage')->min(0.01)->max(100)->nullable();
            $table->float('amount')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('cycles')->nullable();
            $table->timestamps();

            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
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

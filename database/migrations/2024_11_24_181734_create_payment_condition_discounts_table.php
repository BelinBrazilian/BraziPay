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
        Schema::create('payment_condition_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_condition_id')->constrained()->onDelete('cascade');
            $table->decimal('value', 10, 2);
            $table->string('value_type'); // Ex: percentage, fixed
            $table->integer('days_before_due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_condition_discounts');
    }
};

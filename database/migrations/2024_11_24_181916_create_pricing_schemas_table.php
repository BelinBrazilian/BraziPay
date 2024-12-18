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
        Schema::create('pricing_schemas', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->decimal('minimum_price', 10, 2)->nullable();
            $table->string('schema_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_schemas');
    }
};

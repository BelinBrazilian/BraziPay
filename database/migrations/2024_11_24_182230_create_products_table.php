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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_schema_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('external_id')->nullable();
            $table->uuid('code')->unique();
            $table->string('name');
            $table->string('unit')->nullable(); 
            $table->string('status'); 
            $table->text('description')->nullable();
            $table->string('invoice')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

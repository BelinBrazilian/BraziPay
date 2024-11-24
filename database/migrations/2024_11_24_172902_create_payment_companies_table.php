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
        Schema::create('payment_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da empresa (ex: Visa, Mastercard, Cielo)
            $table->string('code')->unique(); // Código da empresa (ex: visa, mastercard, cielo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_companies');
    }
};

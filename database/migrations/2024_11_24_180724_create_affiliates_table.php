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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('bank_account_id')->nullable()->constrained()->onDelete('set null');
            $table->string('login');
            $table->integer('status')->default(0); 
            $table->boolean('enabled')->default(false); 
            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates'); 
    }
};

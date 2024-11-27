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

            // Campos de relacionamento
            // $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null'); // Segunda Migração
            // $table->foreignId('bank_account_id')->nullable()->constrained()->onDelete('set null'); // Segunda Migração

            // Campos principais
            $table->unsignedBigInteger('external_id')->nullable();
            $table->string('login')->unique()->required();
            $table->integer('status')->default(0);
            $table->boolean('enabled')->default(false);

            // Campos adicionais
            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();

            // Timestamps
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

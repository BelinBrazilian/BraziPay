<?php

use App\Http\Enums\ProductInvoiceEnum;
use App\Http\Enums\ProductStatusEnum; // Primeira Migração
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create ou atualizar as tabelas 'products', 'pricing_schemas' e 'pricing_ranges'.
     */
    public function up(): void
    {
        // Tabela 'products'
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Ambas Migrações

            // Relacionamentos e colunas adicionais
            $table->foreignId('pricing_schema_id')->constrained()->onDelete('cascade'); // Segunda Migração
            $table->unsignedBigInteger('external_id')->nullable(); // Ambas Migrações

            // Colunas principais
            $table->string('name'); // Ambas Migrações
            $table->uuid('code')->unique(); // Segunda Migração

            // Unidade
            $table->string('unit')->nullable(); // Segunda Migração

            // Status e descrição
            $table->enum('status', array_column(ProductStatusEnum::cases(), 'value')); // Primeira Migração
            $table->text('description')->nullable(); // Ambas Migrações

            // Invoice e metadados
            $table->enum('invoice', array_column(ProductInvoiceEnum::cases(), 'value'))->nullable(); // Primeira Migração
            $table->json('metadata')->nullable(); // Primeira Migração

            // Timestamps
            $table->timestamps(); // Ambas Migrações
        });
    }

    /**
     * Reverse the migrations by dropping as tabelas 'products', 'pricing_schemas' e 'pricing_ranges'.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Ambas Migrações
    }
};

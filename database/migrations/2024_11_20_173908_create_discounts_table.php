<?php

use App\Http\Enums\DiscountTypeEnum; // Para manter o enum da primeira migração
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

            // Relacionamento
            $table->unsignedBigInteger('external_id')->nullable(); // Primeira Migração

            // Tipo de desconto
            $table->enum('discount_type', array_column(DiscountTypeEnum::cases(), 'value')) // Primeira Migração
                ->comment('Ex: percentage, fixed_amount'); // Adicionando explicação da segunda migração

            // Valores de desconto
            $table->decimal('percentage', 10, 2)->nullable(); // Segunda Migração
            $table->decimal('amount', 10, 2)->nullable(); // Segunda Migração

            // Outros campos
            $table->integer('quantity')->nullable(); // Ambas Migrações
            $table->integer('cycles')->nullable(); // Ambas Migrações

            // Timestamps
            $table->timestamps(); // Ambas Migrações
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

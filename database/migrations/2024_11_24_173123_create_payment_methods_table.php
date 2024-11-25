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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('public_name'); 
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type');
            $table->string('status')->default('active');
            $table->json('settings')->nullable(); // Usando json para armazenar o hash
            $table->string('set_subscription_on_success')->default('do_not_set');
            $table->boolean('allow_as_alternative')->default(true);
            $table->integer('maximum_attempts')->default(0);
            $table->timestamps();
        });

        // Criando a tabela pivot para o relacionamento N:M com payment_companies
        Schema::create('payment_company_payment_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_company_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.   

     */
    public function down(): void
    {
        Schema::dropIfExists('payment_company_payment_method');
        Schema::dropIfExists('payment_methods');
    }
};

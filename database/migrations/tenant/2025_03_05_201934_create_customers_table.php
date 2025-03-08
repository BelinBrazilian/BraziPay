<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateCustomersTable.
 *
 * This migration creates the 'customers' table for storing customer data.
 *
 * Fields:
 * - name: Customer's full name.
 * - email: Customer's email address (unique).
 * - document: Identification document (e.g., CPF, CNPJ, PASSPORT).
 * - document_type: Type of document (e.g., CPF, CNPJ, PASSPORT).
 * - type: Customer type ('individual' or 'company').
 * - phone: Customer's phone number.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.
            $table->string('name', 150)->comment('Customer full name');
            $table->string('email', 150)->unique()->comment('Customer email address');
            $table->string('document', 50)->nullable()->comment('Identification document (e.g., CPF, CNPJ, PASSPORT)');
            $table->string('document_type', 20)->nullable()->comment('Document type (e.g., CPF, CNPJ, PASSPORT)');
            $table->string('type', 20)->nullable()->comment('Customer type (individual or company)');
            $table->string('phone', 30)->nullable()->comment('Customer phone number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}

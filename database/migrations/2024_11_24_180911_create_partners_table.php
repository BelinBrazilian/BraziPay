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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained();
            $table->foreignId('bank_account_id')->constrained();
            $table->string('name');
            $table->string('company_name');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('economic_activity');
            $table->string('phone_number');
            $table->string('template_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};

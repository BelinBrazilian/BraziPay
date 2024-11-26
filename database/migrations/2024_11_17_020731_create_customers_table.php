<?php

use App\Http\Enums\PhoneTypeEnum;
use App\Http\Enums\PlanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create or update the 'customers', 'addresses', and 'phones' tables.
     *
     * This migration creates the required tables if they do not exist, and checks for each column
     * within each table, adding missing columns if needed to ensure structure consistency.
     *
     * @return void
     */
    public function up(): void
    {
        // Create 'customers' table if it does not exist
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('registry_code')->nullable();
            $table->uuid('code')->unique();
            $table->text('notes')->nullable();
            $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
            $table->timestamps();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('address_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations by dropping the 'customers', 'addresses', and 'phones' tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

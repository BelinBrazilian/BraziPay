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
        if (!Schema::hasTable('customers')) {
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
        } else {
            // Check and add missing columns to 'customers' table
            Schema::table('customers', function (Blueprint $table) {
                if (!Schema::hasColumn('customers', 'external_id')) {
                    $table->unsignedBigInteger('external_id')->nullable();
                }
                if (!Schema::hasColumn('customers', 'name')) {
                    $table->string('name');
                }
                if (!Schema::hasColumn('customers', 'email')) {
                    $table->string('email')->unique();
                }
                if (!Schema::hasColumn('customers', 'registry_code')) {
                    $table->string('registry_code')->nullable();
                }
                if (!Schema::hasColumn('customers', 'code')) {
                    $table->uuid('code')->unique();
                }
                if (!Schema::hasColumn('customers', 'notes')) {
                    $table->text('notes')->nullable();
                }
                if (!Schema::hasColumn('customers', 'status')) {
                    $table->enum('status', array_column(PlanStatusEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('customers', 'metadata')) {
                    $table->json('metadata')->nullable();
                }
                if (!Schema::hasColumn('customers', 'address_id')) {
                    $table->unsignedBigInteger('address_id');
                }
                if (!Schema::hasColumn('customers', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        // Create 'addresses' table if it does not exist
        if (!Schema::hasTable('addresses')) {
            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->string('street');
                $table->string('number');
                $table->string('additional_details')->nullable();
                $table->string('zipcode');
                $table->string('neighborhood');
                $table->string('city');
                $table->string('state');
                $table->string('country');
                $table->timestamps();
            });
        } else {
            // Check and add missing columns to 'addresses' table
            Schema::table('addresses', function (Blueprint $table) {
                foreach (['street', 'number', 'additional_details', 'zipcode', 'neighborhood', 'city', 'state', 'country'] as $column) {
                    if (!Schema::hasColumn('addresses', $column)) {
                        $table->string($column)->nullable();
                    }
                }
            });
        }

        // Create 'phones' table if it does not exist
        if (!Schema::hasTable('phones')) {
            Schema::create('phones', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('customer_id');
                $table->enum('phone_type', array_column(PhoneTypeEnum::cases(), 'value'));
                $table->string('number', 15);
                $table->string('extension')->nullable();
                $table->timestamps();
            });
        } else {
            // Check and add missing columns to 'phones' table
            Schema::table('phones', function (Blueprint $table) {
                if (!Schema::hasColumn('phones', 'customer_id')) {
                    $table->unsignedBigInteger('customer_id');
                }
                if (!Schema::hasColumn('phones', 'phone_type')) {
                    $table->enum('phone_type', array_column(PhoneTypeEnum::cases(), 'value'));
                }
                if (!Schema::hasColumn('phones', 'number')) {
                    $table->string('number', 15);
                }
                if (!Schema::hasColumn('phones', 'extension')) {
                    $table->string('extension')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations by dropping the 'customers', 'addresses', and 'phones' tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('phones');
    }
};

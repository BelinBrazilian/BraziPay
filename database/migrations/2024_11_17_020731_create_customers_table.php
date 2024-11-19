<?php

use App\Http\Enums\PhoneTypeEnum;
use App\Http\Enums\PlanStatusEnum;
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
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });

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

        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('phone_type', array_column(PhoneTypeEnum::cases(), 'value'));
            $table->string('number', 15);
            $table->string('extension')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

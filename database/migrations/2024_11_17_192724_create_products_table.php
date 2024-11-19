<?php

use App\Http\Enums\ProductStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabela principal de produtos
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('unit');
            $table->enum('status', array_column(ProductStatusEnum::cases(), 'value'));
            $table->text('description')->nullable();
            $table->enum('invoice', ['always', 'on_demand']);
            $table->timestamps();
            $table->json('metadata')->nullable();
        });

        // Tabela de esquemas de precificação
        Schema::create('pricing_schemas', function (Blueprint $table) {
            $table->id();
            $table->string('short_format');
            $table->decimal('price', 10, 2);
            $table->decimal('minimum_price', 10, 2)->nullable();
            $table->enum('schema_type', ['flat', 'tiered']);
            $table->timestamps();
        });

        // Tabela de intervalos de precificação
        Schema::create('pricing_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pricing_schema_id');
            $table->integer('start_quantity');
            $table->integer('end_quantity')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('overage_price', 10, 2)->nullable();

            $table->foreign('pricing_schema_id')->references('id')->on('pricing_schemas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricing_ranges');
        Schema::dropIfExists('pricing_schemas');
        Schema::dropIfExists('products');
    }
};

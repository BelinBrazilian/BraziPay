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
        Schema::table('plan_items', function (Blueprint $table) {
            $table->foreignId('plan_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->after('cycles')->constrained()->onDelete('cascade');
            $table->foreignId('pricing_schema_id')->after('product_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_items', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn('plan_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->dropForeign(['pricing_schema_id']);
            $table->dropColumn('pricing_schema_id');
        });
    }
};

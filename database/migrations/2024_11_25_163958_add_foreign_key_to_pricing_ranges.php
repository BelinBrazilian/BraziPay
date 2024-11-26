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
        Schema::table('pricing_ranges', function (Blueprint $table) {
            $table->foreignId('pricing_schema_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_ranges', function (Blueprint $table) {
            $table->dropForeign(['pricing_schema_id']);
            $table->dropColumn('pricing_schema_id');
        });
    }
};

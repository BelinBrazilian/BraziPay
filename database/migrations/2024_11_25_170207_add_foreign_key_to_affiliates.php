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
        Schema::table('affiliates', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->after('id')->constrained()->onDelete('set null');
            $table->foreignId('bank_account_id')->nullable()->after('address_id')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropForeign(['bank_account_id']);
            $table->dropColumn(['address_id', 'bank_account_id']);
        });
    }
};
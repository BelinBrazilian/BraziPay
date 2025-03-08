<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateBadgeUserTable.
 *
 * This pivot table associates badges with users, recording when a badge was awarded.
 *
 * Fields:
 * - user_id: Foreign key to the users table.
 * - badge_id: Foreign key to the badges table.
 * - awarded_at: Timestamp when the badge was awarded.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateBadgeCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('badge_customer', function (Blueprint $table) {
            $table->foreignId('customer_id')->comment('Reference to the customer');
            $table->foreignId('badge_id')->comment('Reference to the badge');
            $table->timestamp('awarded_at')->nullable()->comment('Timestamp when the badge was awarded');
            $table->primary(['customer_id', 'badge_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_user');
    }
}

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreatePointTransactionsTable.
 *
 * This table records every point transaction for a user.
 * Each transaction may be linked to a specific gamification plan (action).
 * Fields:
 * - user_id: Reference to the user receiving points.
 * - gamification_plan_id: (Optional) Reference to the gamification plan rule.
 * - points: The number of points awarded (or deducted).
 * - description: Description of the transaction.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreatePointTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.
            $table->foreignId('customer_id')->comment('Reference to the customer');
            $table->foreignId('gamification_plan_id')->nullable()->comment('Reference to the gamification plan rule');
            $table->integer('points')->comment('Points awarded (or deducted) in this transaction');
            $table->text('description')->nullable()->comment('Description of the point transaction');
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
        Schema::dropIfExists('point_transactions');
    }
}

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateGamificationPlansTable.
 *
 * This table stores the rules for awarding points for specific actions.
 * Each record defines:
 * - action: The identifier of the gamification action (e.g., "order_completed", "referral").
 * - points: The number of points awarded for the action.
 * - description: A brief description of the rule.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateGamificationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('gamification_plans', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.
            $table->string('action')->unique()->comment('Unique identifier for the gamification action');
            $table->integer('points')->comment('Points awarded for the action');
            $table->text('description')->nullable()->comment('Description of the gamification rule');
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
        Schema::dropIfExists('gamification_plans');
    }
}

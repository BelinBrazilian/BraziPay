<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: CreateBadgesTable.
 *
 * This table stores the definitions of badges (achievements) that users can earn.
 * Fields:
 * - name: The name of the badge.
 * - slug: A unique slug for the badge.
 * - description: A description of the badge.
 * - criteria: Points required to earn the badge (optional).
 * - image_url: Optional URL for the badge image.
 *
 * @see https://laravel.com/docs/12.x/migrations
 */
class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key.
            $table->string('name')->comment('Name of the badge');
            $table->string('slug')->unique()->comment('Unique slug for the badge');
            $table->text('description')->nullable()->comment('Description of the badge');
            $table->integer('criteria')->nullable()->comment('Minimum points required to earn the badge');
            $table->string('image_url')->nullable()->comment('URL of the badge image');
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
        Schema::dropIfExists('badges');
    }
}

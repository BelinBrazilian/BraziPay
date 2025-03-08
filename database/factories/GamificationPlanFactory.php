<?php

namespace Database\Factories;

use App\Models\GamificationPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class GamificationPlanFactory.
 *
 * This factory creates a random gamification plan with:
 * - action: A random identifier for the action (e.g., "order_completed").
 * - points: A random number of points awarded for the action.
 * - description: A random description.
 *
 * @extends Factory<GamificationPlan>
 */
class GamificationPlanFactory extends Factory
{
    protected $model = GamificationPlan::class;

    public function definition(): array
    {
        $actions = ['order_completed', 'referral', 'first_purchase', 'review_submitted'];
        return [
            'action'      => $this->faker->randomElement($actions) . '-' . $this->faker->unique()->numberBetween(100000000000, 999999999999),
            'points'      => $this->faker->numberBetween(10, 100),
            'description' => $this->faker->sentence,
        ];
    }
}

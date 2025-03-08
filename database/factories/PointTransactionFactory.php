<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\PointTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PointTransactionFactory.
 *
 * This factory creates a random point transaction for a user with:
 * - user_id: Should be assigned via relationship.
 * - gamification_plan_id: Optionally assigned via relationship.
 * - points: A random number of points awarded or deducted.
 * - description: A random description.
 *
 * @extends Factory<PointTransaction>
 */
class PointTransactionFactory extends Factory
{
    protected $model = PointTransaction::class;

    public function definition(): array
    {
        return [
            'user_id'     => Customer::factory(),
            'points'      => $this->faker->numberBetween(10, 200),
            'description' => $this->faker->sentence,
        ];
    }
}

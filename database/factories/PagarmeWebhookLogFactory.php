<?php

namespace Database\Factories;

use App\Models\PagarmeWebhookLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PagarmeWebhookLogFactory.
 *
 * This factory creates a random webhook log for Pagar.me with:
 * - payload: A random JSON payload.
 * - received_at: A random timestamp.
 *
 * @extends Factory<PagarmeWebhookLog>
 */
class PagarmeWebhookLogFactory extends Factory
{
    protected $model = PagarmeWebhookLog::class;

    public function definition(): array
    {
        return [
            'payload'     => [
                'event' => $this->faker->word,
                'data'  => $this->faker->sentence,
            ],
            'received_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}

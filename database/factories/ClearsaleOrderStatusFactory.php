<?php

namespace Database\Factories;

use App\Models\ClearsaleOrder;
use App\Models\ClearsaleOrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsaleOrderStatusFactory.
 *
 * This factory creates a random ClearSale order status with:
 * - status: A random status code selected from ClearSale status list.
 * - score: A random risk score (or null).
 *
 * @extends Factory<ClearsaleOrderStatus>
 */
class ClearsaleOrderStatusFactory extends Factory
{
    protected $model = ClearsaleOrderStatus::class;

    public function definition(): array
    {
        $statusOptions = ['APA', 'APM', 'RPM', 'AMA', 'ERR', 'NVO', 'SUS', 'CAN', 'FRD', 'RPA', 'RPP', 'APG'];
        return [
            'clearsale_order_id'    => ClearsaleOrder::inRandomOrder()->first()->id,
            'status'                => $this->faker->randomElement($statusOptions),
            'score'                 => $this->faker->optional()->randomFloat(4, 0, 100),
        ];
    }
}

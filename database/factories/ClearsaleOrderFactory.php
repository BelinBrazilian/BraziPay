<?php

namespace Database\Factories;

use App\Models\ClearsaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsaleOrderFactory.
 *
 * This factory creates a random ClearSale order with:
 * - order_id: A random internal order identifier.
 * - clearsale_order_id: A random ClearSale order identifier (or null).
 * - date: A random date and time.
 * - email: A random email.
 * - total_items, total_order, total_shipping: Random monetary values.
 * - currency: A random ISO currency code.
 * - ip: A random IP address.
 * - origin: A random source (e.g., Mobile, Web).
 * - session_id: A random session identifier.
 * - reanalysis: A random boolean flag.
 *
 * @extends Factory<ClearsaleOrder>
 */
class ClearsaleOrderFactory extends Factory
{
    protected $model = ClearsaleOrder::class;

    public function definition(): array
    {
        return [
            'order_id'          => $this->faker->bothify('order-########'),
            'clearsale_order_id'=> $this->faker->optional()->bothify('csorder-########'),
            'date'              => $this->faker->dateTimeBetween('-1 year', 'now'),
            'email'             => $this->faker->unique()->safeEmail,
            'total_items'       => $this->faker->randomFloat(4, 10, 500),
            'total_order'       => $this->faker->randomFloat(4, 10, 1000),
            'total_shipping'    => $this->faker->optional()->randomFloat(4, 0, 50),
            'currency'          => $this->faker->randomElement(['BRL', 'USD', 'EUR', 'GBP']),
            'ip'                => $this->faker->ipv4,
            'origin'            => $this->faker->randomElement(['Mobile', 'Web']),
            'session_id'        => $this->faker->uuid,
            'reanalysis'        => $this->faker->boolean,
        ];
    }
}

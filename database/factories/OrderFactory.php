<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class OrderFactory.
 *
 * This factory generates random checkout orders with:
 * - user_id: Associated with a randomly created user.
 * - total: A random total amount.
 * - status: Randomly chosen from a list of statuses.
 * - payment_id: Optionally a random payment transaction ID.
 *
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $statuses = ['pending', 'paid', 'failed'];
        return [
            'customer_id' => Customer::factory(),
            'total'       => $this->faker->randomFloat(4, 10, 1000),
            'status'      => $this->faker->randomElement($statuses),
            'payment_id'  => $this->faker->optional()->bothify('pay_########'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\ClearsaleOrder;
use App\Models\ClearsalePayment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsalePaymentFactory.
 *
 * This factory creates a random ClearSale payment record with:
 * - payment_date: A random payment date.
 * - card_type: A random numeric code (1 to 7, for example).
 * - card_expiration_date: A random expiration date in MM/YY format.
 * - type: A random numeric code for payment method.
 * - card_holder_name: A random full name.
 * - card_end_number: A random 4-digit string.
 * - card_bin: A random 6-digit string.
 * - amount: A random monetary value.
 *
 * @extends Factory<ClearsalePayment>
 */
class ClearsalePaymentFactory extends Factory
{
    protected $model = ClearsalePayment::class;

    public function definition(): array
    {
        return [
            'clearsale_order_id'   => ClearsaleOrder::inRandomOrder()->first()->id,
            'payment_date'         => $this->faker->date(),
            'card_type'            => $this->faker->numberBetween(1, 7),
            'card_expiration_date' => $this->faker->numerify('##/##'),
            'type'                 => $this->faker->numberBetween(1, 19),
            'card_holder_name'     => $this->faker->name,
            'card_end_number'      => $this->faker->numerify('####'),
            'card_bin'             => $this->faker->numerify('######'),
            'amount'               => $this->faker->randomFloat(4, 1, 500),
        ];
    }
}

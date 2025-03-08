<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PagarmeCharge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class PagarmeChargeFactory.
 *
 * This factory creates a random charge record from Pagar.me with:
 * - order_id: Should be assigned via relationship.
 * - charge_id: A unique charge identifier.
 * - amount: A random monetary value.
 * - status: A random charge status from allowed values.
 * - payment_method: A random payment method from allowed values.
 * - gateway_id: An optional gateway-specific identifier.
 *
 * @extends Factory<PagarmeCharge>
 */
class PagarmeChargeFactory extends Factory
{
    protected $model = PagarmeCharge::class;

    public function definition(): array
    {
        $statuses = ['pending', 'paid', 'canceled', 'processing', 'failed', 'overpaid', 'underpaid', 'chargedback'];
        $paymentMethods = ['credit_card', 'boleto', 'pix', 'voucher', 'bank_transfer', 'safetypay', 'checkout', 'cash', 'private_label', 'debit_card'];

        return [
            'order_id'       => Order::factory(),
            'charge_id'      => 'charge_' . Str::random(10),
            'amount'         => $this->faker->randomFloat(4, 100, 10000),
            'status'         => $this->faker->randomElement($statuses),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'gateway_id'     => $this->faker->optional()->bothify('gw_##??'),
        ];
    }
}

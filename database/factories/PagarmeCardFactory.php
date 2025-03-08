<?php

namespace Database\Factories;

use App\Models\PagarmeCard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class PagarmeCardFactory.
 *
 * This factory creates a random tokenized card for Pagar.me with:
 * - customer_id: Should be assigned via relationship.
 * - card_id: A unique card identifier.
 * - last_four: A random 4-digit string.
 * - brand: A random card brand.
 * - token: A random token string (optional).
 *
 * @extends Factory<PagarmeCard>
 */
class PagarmeCardFactory extends Factory
{
    protected $model = PagarmeCard::class;

    public function definition(): array
    {
        $brands = ['Visa', 'MasterCard', 'Amex', 'Diners', 'Hipercard'];
        return [
            // 'customer_id' should be set via relationship.
            'card_id'   => 'card_' . Str::random(10),
            'last_four' => $this->faker->numerify('####'),
            'brand'     => $this->faker->randomElement($brands),
            'token'     => $this->faker->optional()->lexify('token_??????'),
        ];
    }
}

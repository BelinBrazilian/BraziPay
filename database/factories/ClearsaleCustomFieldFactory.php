<?php

namespace Database\Factories;

use App\Models\ClearsaleCustomField;
use App\Models\ClearsaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsaleCustomFieldFactory.
 *
 * This factory creates a random Clearsale custom field with:
 * - name: A random key.
 * - value: A random value.
 * - type: A random numeric type (or null).
 *
 * @extends Factory<ClearsaleCustomField>
 */
class ClearsaleCustomFieldFactory extends Factory
{
    protected $model = ClearsaleCustomField::class;

    public function definition(): array
    {
        return [
            'clearsale_order_id'    => ClearsaleOrder::inRandomOrder()->first()->id,
            'name'                  => $this->faker->word,
            'value'                 => $this->faker->word,
            'type'                  => $this->faker->optional()->numberBetween(1, 5),
        ];
    }
}

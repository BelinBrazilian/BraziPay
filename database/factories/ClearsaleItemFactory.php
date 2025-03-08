<?php

namespace Database\Factories;

use App\Models\ClearsaleItem;
use App\Models\ClearsaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsaleItemFactory.
 *
 * This factory creates a random item for a ClearSale order with:
 * - product_id: A random product identifier.
 * - product_title: A random product name.
 * - price: A random unit price.
 * - quantity: A random quantity.
 * - category: A random category name (optional).
 *
 * @extends Factory<ClearsaleItem>
 */
class ClearsaleItemFactory extends Factory
{
    protected $model = ClearsaleItem::class;

    public function definition(): array
    {
        return [
            'clearsale_order_id'    => ClearsaleOrder::inRandomOrder()->first()->id,
            'product_id'            => $this->faker->bothify('prod-####'),
            'product_title'         => $this->faker->words(3, true),
            'price'                 => $this->faker->randomFloat(4, 1, 1000),
            'quantity'              => $this->faker->numberBetween(1, 10),
            'category'              => $this->faker->optional()->word,
        ];
    }
}

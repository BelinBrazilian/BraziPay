<?php

namespace Database\Factories;

use App\Models\ClearsaleAddress;
use App\Models\ClearsaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ClearsaleAddressFactory.
 *
 * This factory creates a random Clearsale address with:
 * - address_line1: A random street address.
 * - address_line2: A random complement.
 * - city: A random city.
 * - state: A random two-letter state code.
 * - zip_code: A random postal code.
 * - country: A random country name.
 *
 * @extends Factory<ClearsaleAddress>
 */
class ClearsaleAddressFactory extends Factory
{
    protected $model = ClearsaleAddress::class;

    public function definition(): array
    {
        return [
            'clearsale_order_id'    => ClearsaleOrder::inRandomOrder()->first()->id,
            'address_line1'         => $this->faker->streetAddress,
            'address_line2'         => $this->faker->optional()->secondaryAddress,
            'city'                  => $this->faker->city,
            'state'                 => strtoupper($this->faker->lexify('??')),
            'zip_code'              => $this->faker->postcode,
            'country'               => $this->faker->country,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\Address as BrazilianAddress;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new BrazilianAddress($this->faker));

        $user = User::with('addresses')
            ->where('id', '>', 1)
            ->doesntHave('addresses')
            ->inRandomOrder()
            ->first(); // Retrieve a random user

        return [
            'user_id' => $user ? $user->id : null, // Garante que não seja nulo
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'additional_details' => $this->faker->optional()->secondaryAddress(),
            'zipcode' => $this->faker->postcode(), // Formato brasileiro de CEP
            'neighborhood' => $this->faker->streetSuffix(), // Bairro em português
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(), // Sigla do estado
            'country' => 'BR', // Código do país fixado como Brasil
        ];
    }
}

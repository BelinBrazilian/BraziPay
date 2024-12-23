<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // Cria um cliente relacionado
            'phone_type' => $this->faker->randomElement(['mobile', 'landline', 'work']), // Tipo de telefone
            'number' => $this->faker->numerify('(##) #####-####'), // Número de telefone
            'extension' => $this->faker->optional()->numerify('####'), // Ramal (opcional)
        ];
    }
}

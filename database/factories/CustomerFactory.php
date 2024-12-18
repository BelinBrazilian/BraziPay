<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'address_id' => Address::factory(), // Cria um endereço relacionado
            'external_id' => $this->faker->uuid, // Gera um identificador único
            'code' => strtoupper($this->faker->bothify('CUST-####')), // Código no formato CUST-1234
            'name' => $this->faker->name, // Nome completo
            'email' => $this->faker->safeEmail, // Email fictício
            'registry_code' => $this->faker->numerify('###########'), // Simula um CPF ou registro
            'notes' => $this->faker->optional()->sentence, // Notas adicionais (opcional)
        ];
    }
}

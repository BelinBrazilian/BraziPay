<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class CustomerFactory.
 *
 * This factory generates random customer data.
 *
 * Fields:
 * - name: A random full name.
 * - email: A unique email address.
 * - document: A random document number (formatted differently for CNPJ or CPF/PASSPORT).
 * - document_type: Randomly chosen from typical values ('CPF', 'CNPJ', 'PASSPORT').
 * - type: Determined based on the document type ('individual' for CPF or PASSPORT; 'company' for CNPJ).
 * - phone: A random phone number.
 *
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        // Choose a document type randomly.
        $documentType = $this->faker->randomElement(['CPF', 'CNPJ', 'PASSPORT']);
        // Define customer type based on document type.
        $type = in_array($documentType, ['CPF', 'PASSPORT']) ? 'individual' : 'company';

        return [
            'name'          => $this->faker->name,
            'email'         => $this->faker->unique()->safeEmail,
            'document'      => $documentType === 'CNPJ'
                ? $this->faker->numerify('########/####-##')
                : $this->faker->numerify('###########'),
            'document_type' => $documentType,
            'type'          => $type,
            'phone'         => $this->faker->phoneNumber,
        ];
    }
}

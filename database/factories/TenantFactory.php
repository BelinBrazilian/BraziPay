<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class TenantFactory.
 *
 * This factory generates random tenant data for testing purposes.
 *
 * It sets the following fields:
 * - id: A unique tenant identifier using a random string.
 * - name: A random company name representing the store.
 * - plan: A random subscription plan selected from a predefined list.
 * - currency: A random currency code (ISO 4217, e.g., BRL, USD, EUR, GBP).
 * - filament_theme: A random theme for the Filament admin panel.
 * - pagarme_api_key: A fake API key in the format "sk_test_{random}".
 * - clearsale_api_key: A fake API key in the format "cs_test_{random}".
 *
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plans = ['free', 'premium', 'business', 'enterprise'];
        $currencies = ['BRL', 'USD', 'EUR', 'GBP'];
        $themes = ['default', 'dark', 'light', 'corporate'];

        return [
            // Generate a unique tenant id with a prefix "tenant-"
            'id'                => 'tenant-' . Str::random(8),
            'name'              => $this->faker->company,
            'plan'              => $this->faker->randomElement($plans),
            'currency'          => $this->faker->randomElement($currencies),
            'filament_theme'    => $this->faker->randomElement($themes),
            'pagarme_api_key'   => 'sk_test_' . Str::random(10),
            'clearsale_api_key' => 'cs_test_' . Str::random(10),
            // 'data' column can be used for additional custom data if needed.
            'data'              => null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'notification_type' => $this->faker->randomElement(['email', 'sms', 'push']),
            'name' => $this->faker->words(3, true),
            'subject' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'trigger_type' => $this->faker->randomElement(['time_based', 'event_based']),
            'trigger_day' => $this->faker->numberBetween(1, 30), // Always generates a number between 1 and 30
            'bcc' => $this->faker->optional()->email, // Nullable email
        ];
    }
}

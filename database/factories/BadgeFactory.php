<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class BadgeFactory.
 *
 * This factory creates a random badge with:
 * - name: A random badge name.
 * - slug: A unique slug based on the name.
 * - description: A random description.
 * - criteria: A random number (or null) for the points criteria.
 * - image_url: A random image URL.
 *
 * @extends Factory<Badge>
 */
class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(3);
        return [
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . Str::random(4),
            'description' => $this->faker->paragraph,
            'criteria'    => $this->faker->optional()->numberBetween(100, 1000),
            'image_url'   => $this->faker->optional()->imageUrl(200, 200, 'business'),
        ];
    }
}

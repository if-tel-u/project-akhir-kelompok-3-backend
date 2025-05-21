<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'electronics',
            'furniture',
            'clothing',
            'books',
        ];

        return [
            'name' => $this->faker->words(1, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(0, 1, 999) * 1000,
            'category' => $this->faker->randomElement($categories),
            'image_url' => $this->faker->imageUrl(640, 480, 'technics', true),
            'user_id' => $this->faker->numberBetween(1, User::count()),
        ];
    }
}

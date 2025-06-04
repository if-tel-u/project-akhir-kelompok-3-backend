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
        $imageUrls = [
        'https://images.unsplash.com/photo-1557180295-76eee20ae8aa?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8b2JqZWN0c3xlbnwwfHwwfHx8MA%3D%3D',
        'https://images.unsplash.com/photo-1415604934674-561df9abf539?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8b2JqZWN0c3xlbnwwfHwwfHx8MA%3D%3D',
        'https://images.unsplash.com/photo-1563219996-45f1a0ba692e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fG9iamVjdHN8ZW58MHx8MHx8fDA%3D',
        'https://images.unsplash.com/photo-1599987662084-97832741bfa2?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fG9iamVjdHN8ZW58MHx8MHx8fDA%3D',
        'https://media.istockphoto.com/id/869078270/photo/armchair-isolated-on-white-background-3d-rendering.webp?a=1&b=1&s=612x612&w=0&k=20&c=3hT469tDl_4ttthWj2rPqCArA47d6g8yeaz2E7uCZKA=',
        // Tambahkan lebih banyak URL jika mau
    ];

        return [
            'name' => $this->faker->words(1, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(0, 1, 999) * 1000,
            'category' => $this->faker->randomElement($categories),
            'image_url' => $this->faker->randomElement($imageUrls),
            'user_id' => $this->faker->numberBetween(1, User::count()),
        ];
    }
}

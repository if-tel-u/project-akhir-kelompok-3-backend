<?php

namespace Database\Factories;

use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'fullname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'contact_number' => $this->faker->unique()->phoneNumber,
            'password' => Hash::make($this->faker->password),
        ];
    }
}

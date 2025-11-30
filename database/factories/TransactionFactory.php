<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'invoice' => fake()->numberBetween(10, 1000),
            'total' => fake()->numberBetween(10, 20),
            'pay' => fake()->numberBetween(10, 20),
            'return' => fake()->numberBetween(10, 20),
        ];
    }
}

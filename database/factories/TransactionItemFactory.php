<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionItem>
 */
class TransactionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // Init

        return [
            'transaction_id' => \App\Models\Transaction::factory(),
            'product_id' => \App\Models\Product::factory(),
            'price' => function (array $attributes) {
                return \App\Models\Product::find($attributes['product_id'])->price;
            },
            'quantity' => fake()->randomNumber(2, false),
        ];
    }
}

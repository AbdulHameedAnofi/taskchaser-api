<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->pluck('id')->toArray();
        $product = Product::all();
        return [
            'user_id' => fake()->randomElement($user),
            'product_id' => fake()->randomElement($product->pluck('id')->toArray()),
            'quantity' => 1,
            'total' => fake()->randomElement($product->pluck('amount')->toArray()),
        ];
    }
}

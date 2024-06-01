<?php

namespace Database\Factories;

use App\Models\Cake;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartCake>
 */
class CartCakeFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => 1,
            'cake_id' => Cake::factory(),
            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}

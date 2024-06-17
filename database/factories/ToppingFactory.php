<?php

namespace Database\Factories;

use App\Models\Topping;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topping>
 */
class ToppingFactory extends Factory
{

    protected $model = Topping::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = number_format($this->faker->randomFloat(2, 5, 10), 2);

        return [
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'flavors', true, 'cakes'),
            'price' => $price,
        ];
    }
}

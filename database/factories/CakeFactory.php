<?php

namespace Database\Factories;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{

    protected $model = Cake::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $price = number_format($this->faker->randomFloat(2, 5, 100), 2);

        return [
            'name' => $this->faker->word,
            'flavor' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'food', true, 'cakes'),
            'number_of_people' => $this->faker->numberBetween(1, 20),
            'price' => $price,
            'category_id' => Category::factory()
        ];
    }
}

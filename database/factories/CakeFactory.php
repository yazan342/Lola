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
        $flavors = [
            'vanilla', 'chocolate', 'strawberry', 'lemon', 'carrot', 'red velvet', 'black forest', 'cheesecake', 'banana', 'coffee', 'pistachio'
        ];

        $adjectives = [
            'Delicious', 'Scrumptious', 'Tasty', 'Mouth-watering', 'Decadent', 'Luscious', 'Heavenly', 'Yummy', 'Delectable', 'Savory'
        ];

        $types = [
            'Cake', 'Pastry', 'Tart', 'Cupcake', 'Gateau', 'Torte'
        ];

        $numberOfPeople = $this->faker->numberBetween(1, 20);
        $pricePerPerson = $this->faker->randomFloat(2, 1.5, 5.0); // Price per person between $1.50 and $5.00
        $price = number_format($numberOfPeople * $pricePerPerson, 2);


        $images = [
            'cake1.jpg',
            'cake2.jpg',
            'cake3.jpg',
            'cake4.jpg',
            'cake5.jpg',
        ];

        return [
            'name' => $this->faker->randomElement($adjectives) . ' ' . $this->faker->randomElement($types),
            'flavor' => $this->faker->randomElement($flavors),
            'image' => $this->faker->randomElement($images),
            'number_of_people' => $numberOfPeople,
            'price' => $price,
            'category_id' => Category::factory()
        ];
    }
}

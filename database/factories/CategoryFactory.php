<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Birthday Cakes',
            'Wedding Cakes',
            'Graduation Cakes',
            'Valentine Cakes'
        ];

        $images = [
            'birthday.jpg',
            'wedding.jpg',
            'graduation.jpg',
            'valentine.jpg',
        ];

        return [
            'title' => $this->faker->randomElement($categories),
            'image' => $this->faker->randomElement($images)
        ];
    }
}

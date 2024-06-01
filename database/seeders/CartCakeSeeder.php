<?php

namespace Database\Seeders;

use App\Models\CartCake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartCakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CartCake::factory(10)->create();
    }
}

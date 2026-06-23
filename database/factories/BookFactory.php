<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,

            'title' => fake()->sentence(3),

            'author' => fake()->name(),

            'publisher' => fake()->company(),

            'publication_year' => fake()->numberBetween(2015, 2025),

            'description' => fake()->paragraph(),

            'cover_image_path' => null,
        ];
    }
}

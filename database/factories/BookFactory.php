<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'author_id' => Author::factory(),
            'book_title' => fake()->sentence(3),
            'price' => fake()->randomFloat(2, 100, 1500),
            'stock_quantity' => fake()->numberBetween(0, 100),
        ];
    }
}

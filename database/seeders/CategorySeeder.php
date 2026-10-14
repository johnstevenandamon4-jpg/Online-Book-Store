<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Programming',
                'description' => 'Books about programming and software development.',
                'icon' => 'code',
                'status' => 'active',
            ],
            [
                'category_name' => 'Science',
                'description' => 'Books about science and scientific discoveries.',
                'icon' => 'flask',
                'status' => 'active',
            ],
            [
                'category_name' => 'Mathematics',
                'description' => 'Books about mathematics and problem solving.',
                'icon' => 'calculator',
                'status' => 'active',
            ],
            [
                'category_name' => 'Literature',
                'description' => 'Novels, stories, and literary works.',
                'icon' => 'book-open',
                'status' => 'active',
            ],
            [
                'category_name' => 'History',
                'description' => 'Books about historical events and people.',
                'icon' => 'landmark',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['category_name' => $category['category_name']],
                $category
            );
        }
    }
}

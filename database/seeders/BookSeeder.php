<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'category' => 'Programming',
                'author_email' => 'robert.martin@example.com',
                'book_title' => 'Clean Code',
                'price' => 850.00,
                'stock_quantity' => 15,
            ],
            [
                'category' => 'Programming',
                'author_email' => 'joshua.bloch@example.com',
                'book_title' => 'Effective Java',
                'price' => 950.00,
                'stock_quantity' => 10,
            ],
            [
                'category' => 'Programming',
                'author_email' => 'andrew.hunt@example.com',
                'book_title' => 'The Pragmatic Programmer',
                'price' => 780.00,
                'stock_quantity' => 12,
            ],
            [
                'category' => 'Programming',
                'author_email' => 'martin.fowler@example.com',
                'book_title' => 'Refactoring',
                'price' => 900.00,
                'stock_quantity' => 8,
            ],
            [
                'category' => 'Mathematics',
                'author_email' => 'donald.knuth@example.com',
                'book_title' => 'Concrete Mathematics',
                'price' => 720.00,
                'stock_quantity' => 6,
            ],
        ];

        foreach ($books as $bookData) {
            $category = Category::where(
                'category_name',
                $bookData['category']
            )->firstOrFail();

            $author = Author::where(
                'email',
                $bookData['author_email']
            )->firstOrFail();

            Book::updateOrCreate(
                ['book_title' => $bookData['book_title']],
                [
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'book_title' => $bookData['book_title'],
                    'price' => $bookData['price'],
                    'stock_quantity' => $bookData['stock_quantity'],
                ]
            );
        }
    }
}

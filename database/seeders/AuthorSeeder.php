<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'first_name' => 'Robert',
                'last_name' => 'Martin',
                'email' => 'robert.martin@example.com',
                'address' => 'New York, USA',
            ],
            [
                'first_name' => 'Joshua',
                'last_name' => 'Bloch',
                'email' => 'joshua.bloch@example.com',
                'address' => 'California, USA',
            ],
            [
                'first_name' => 'Andrew',
                'last_name' => 'Hunt',
                'email' => 'andrew.hunt@example.com',
                'address' => 'Colorado, USA',
            ],
            [
                'first_name' => 'Martin',
                'last_name' => 'Fowler',
                'email' => 'martin.fowler@example.com',
                'address' => 'London, UK',
            ],
            [
                'first_name' => 'Donald',
                'last_name' => 'Knuth',
                'email' => 'donald.knuth@example.com',
                'address' => 'California, USA',
            ],
        ];

        foreach ($authors as $author) {
            Author::updateOrCreate(
                ['email' => $author['email']],
                $author
            );
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        $customer = Customer::factory()->create();
        $book = Book::factory()->create();
        $quantity = fake()->numberBetween(1, 5);

        return [
            'customer_id' => $customer->id,
            'book_id' => $book->id,
            'quantity' => $quantity,
            'total_amount' => round($book->price * $quantity, 2),
            'payment_type' => fake()->randomElement([
                'Cash on Delivery',
                'GCash',
                'Bank Transfer',
            ]),
            'order_status' => fake()->randomElement([
                'Pending',
                'Processing',
                'Completed',
                'Cancelled',
            ]),
        ];
    }
}

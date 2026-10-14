<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'customer_email' => 'john.santos@example.com',
                'book_title' => 'Clean Code',
                'quantity' => 2,
                'payment_type' => 'Cash on Delivery',
                'order_status' => 'Pending',
            ],
            [
                'customer_email' => 'maria.reyes@example.com',
                'book_title' => 'Effective Java',
                'quantity' => 1,
                'payment_type' => 'GCash',
                'order_status' => 'Processing',
            ],
            [
                'customer_email' => 'mark.delacruz@example.com',
                'book_title' => 'The Pragmatic Programmer',
                'quantity' => 3,
                'payment_type' => 'Bank Transfer',
                'order_status' => 'Completed',
            ],
            [
                'customer_email' => 'angela.garcia@example.com',
                'book_title' => 'Refactoring',
                'quantity' => 1,
                'payment_type' => 'Cash on Delivery',
                'order_status' => 'Pending',
            ],
            [
                'customer_email' => 'daniel.flores@example.com',
                'book_title' => 'Concrete Mathematics',
                'quantity' => 2,
                'payment_type' => 'GCash',
                'order_status' => 'Processing',
            ],
        ];

        foreach ($orders as $orderData) {
            $customer = Customer::where(
                'email',
                $orderData['customer_email']
            )->firstOrFail();

            $book = Book::where(
                'book_title',
                $orderData['book_title']
            )->firstOrFail();

            $quantity = $orderData['quantity'];

            Order::firstOrCreate(
                [
                    'customer_id' => $customer->id,
                    'book_id' => $book->id,
                ],
                [
                    'quantity' => $quantity,
                    'total_amount' => $book->price * $quantity,
                    'payment_type' => $orderData['payment_type'],
                    'order_status' => $orderData['order_status'],
                ]
            );
        }
    }
}

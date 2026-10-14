<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'full_name' => 'John Santos',
                'email' => 'john.santos@example.com',
                'contact_number' => '09171234567',
                'shipping_address' => 'Mandaue City, Cebu',
            ],
            [
                'full_name' => 'Maria Reyes',
                'email' => 'maria.reyes@example.com',
                'contact_number' => '09181234567',
                'shipping_address' => 'Cebu City, Cebu',
            ],
            [
                'full_name' => 'Mark Dela Cruz',
                'email' => 'mark.delacruz@example.com',
                'contact_number' => '09191234567',
                'shipping_address' => 'Lapu-Lapu City, Cebu',
            ],
            [
                'full_name' => 'Angela Garcia',
                'email' => 'angela.garcia@example.com',
                'contact_number' => '09201234567',
                'shipping_address' => 'Consolacion, Cebu',
            ],
            [
                'full_name' => 'Daniel Flores',
                'email' => 'daniel.flores@example.com',
                'contact_number' => '09211234567',
                'shipping_address' => 'Talisay City, Cebu',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }
    }
}

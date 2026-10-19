<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books' => Book::count(),
            'categories' => Category::count(),
            'authors' => Author::count(),
            'customers' => Customer::count(),
            'orders' => Order::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}

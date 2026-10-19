<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('customers', CustomerController::class);
Route::resource('orders', OrderController::class);

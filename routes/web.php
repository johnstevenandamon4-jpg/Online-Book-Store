<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('customers', CustomerController::class);
Route::resource('orders', OrderController::class);
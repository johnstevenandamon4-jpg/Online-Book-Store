<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'author'])
            ->latest()
            ->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')
            ->orderBy('category_name')
            ->get();

        $authors = Author::orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],
            'author_id' => [
                'required',
                'integer',
                'exists:authors,id',
            ],
            'book_title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'author']);

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::where(function ($query) use ($book) {
            $query->where('status', 'active')
                ->orWhere('id', $book->category_id);
        })->orderBy('category_name')->get();

        $authors = Author::orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view(
            'books.edit',
            compact('book', 'categories', 'authors')
        );
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],
            'author_id' => [
                'required',
                'integer',
                'exists:authors,id',
            ],
            'book_title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->orders()->exists()) {
            return redirect()
                ->route('books.index')
                ->with(
                    'error',
                    'Cannot delete a book that has existing orders.'
                );
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}

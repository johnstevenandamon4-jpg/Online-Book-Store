@extends('app')

@section('title', 'Book Details - Online Book Store')

@section('content')
<div class="mb-4">
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        &larr; Back to Books
    </a>

    <h2 class="page-title">Book Details</h2>
    <p class="text-muted mb-0">
        View the information for this book.
    </p>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">{{ $book->book_title }}</h5>
    </div>

    <div class="card-body p-4">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Book ID</div>
            <div class="col-md-8">{{ $book->id }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Book Title</div>
            <div class="col-md-8">{{ $book->book_title }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Category</div>
            <div class="col-md-8">
                {{ $book->category->category_name }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Author</div>
            <div class="col-md-8">
                {{ $book->author->first_name }}
                {{ $book->author->last_name }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Price</div>
            <div class="col-md-8">
                ₱{{ number_format($book->price, 2) }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Stock Quantity</div>
            <div class="col-md-8">
                @if ($book->stock_quantity > 0)
                    <span class="badge bg-success">
                        {{ $book->stock_quantity }} available
                    </span>
                @else
                    <span class="badge bg-danger">Out of stock</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Date Added</div>
            <div class="col-md-8">
                {{ $book->created_at->format('F d, Y h:i A') }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Last Updated</div>
            <div class="col-md-8">
                {{ $book->updated_at->format('F d, Y h:i A') }}
            </div>
        </div>
    </div>

    <div class="card-footer bg-white d-flex gap-2">
        <a
            href="{{ route('books.edit', $book) }}"
            class="btn btn-warning"
        >
            Edit Book
        </a>

        <a
            href="{{ route('books.index') }}"
            class="btn btn-secondary"
        >
            Back to List
        </a>
    </div>
</div>
@endsection

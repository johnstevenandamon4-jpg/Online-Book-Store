@extends('app')

@section('title', 'Author Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Author Details</h2>
        <p class="text-muted mb-0">View the author's information and books.</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('authors.edit', $author) }}"
           class="btn btn-warning">
            Edit Author
        </a>

        <a href="{{ route('authors.index') }}"
           class="btn btn-secondary">
            Back to Authors
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Author Information</h5>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Full Name</div>
            <div class="col-md-8">
                {{ $author->first_name }} {{ $author->last_name }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Email Address</div>
            <div class="col-md-8">
                {{ $author->email ?? 'Not provided' }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Address</div>
            <div class="col-md-8">
                {{ $author->address ?? 'Not provided' }}
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4 fw-bold">Total Books</div>
            <div class="col-md-8">
                {{ $author->books->count() }}
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Books by This Author</h5>
    </div>

    <div class="card-body">
        @if ($author->books->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Book Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($author->books as $book)
                            <tr>
                                <td>{{ $book->book_title }}</td>
                                <td>
                                    {{ $book->category->category_name }}
                                </td>
                                <td>
                                    ₱{{ number_format($book->price, 2) }}
                                </td>
                                <td>{{ $book->stock_quantity }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book) }}"
                                       class="btn btn-sm btn-info">
                                        View Book
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mb-0">
                This author has no books registered yet.
            </p>
        @endif
    </div>
</div>
@endsection

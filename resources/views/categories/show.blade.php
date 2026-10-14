
@extends('app')

@section('title', 'Category Details - Online Book Store')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        &larr; Back to Categories
    </a>

    <h2 class="page-title">Category Details</h2>
    <p class="text-muted mb-0">
        View the information and books associated with this category.
    </p>
</div>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">{{ $category->category_name }}</h5>
    </div>

    <div class="card-body p-4">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Category ID</div>
            <div class="col-md-8">{{ $category->id }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Category Name</div>
            <div class="col-md-8">{{ $category->category_name }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Description</div>
            <div class="col-md-8">{{ $category->description ?: 'No description provided.' }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Icon or Symbol</div>
            <div class="col-md-8">{{ $category->icon ?: '—' }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Status</div>
            <div class="col-md-8">
                @if ($category->status === 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Date Created</div>
            <div class="col-md-8">{{ $category->created_at->format('F d, Y h:i A') }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Last Updated</div>
            <div class="col-md-8">{{ $category->updated_at->format('F d, Y h:i A') }}</div>
        </div>
    </div>

    <div class="card-footer bg-white d-flex gap-2">
        <a
            href="{{ route('categories.edit', $category) }}"
            class="btn btn-warning"
        >
            Edit Category
        </a>

        <a
            href="{{ route('categories.index') }}"
            class="btn btn-secondary"
        >
            Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Books in This Category</h5>
    </div>

    <div class="card-body">
        @if ($category->books->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Book ID</th>
                            <th>Book Title</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($category->books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->book_title }}</td>
                                <td>₱{{ number_format($book->price, 2) }}</td>
                                <td>{{ $book->stock_quantity }}</td>
                                <td>
                                    <a
                                        href="{{ route('books.show', $book) }}"
                                        class="btn btn-sm btn-info"
                                    >
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
                No books have been assigned to this category yet.
            </p>
        @endif
    </div>
</div>
@endsection

@extends('app')

@section('title', 'Books - Online Book Store')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">Books</h2>
        <p class="text-muted mb-0">
            Manage your bookstore inventory.
        </p>
    </div>

    <a href="{{ route('books.create') }}" class="btn btn-primary">
        + Add Book
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($books->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Book Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->book_title }}</td>
                                <td>{{ $book->category->category_name }}</td>
                                <td>{{ $book->author->author_name }}</td>
                                <td>₱{{ number_format($book->price, 2) }}</td>
                                <td>{{ $book->stock_quantity }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a
                                            href="{{ route('books.show', $book) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('books.edit', $book) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('books.destroy', $book) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this book?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                @if ($book->orders()->exists())
                                                    disabled
                                                    title="This book has orders and cannot be deleted."
                                                @endif
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <h5>No books found</h5>
                <p class="text-muted">
                    Add your first book to get started.
                </p>

                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    Add First Book
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

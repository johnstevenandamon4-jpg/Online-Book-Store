@extends('app')

@section('title', 'Edit Book - Online Book Store')

@section('content')
<div class="mb-4">
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        &larr; Back to Books
    </a>

    <h2 class="page-title">Edit Book</h2>
    <p class="text-muted mb-0">
        Update the information for "{{ $book->book_title }}".
    </p>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input
                    type="text"
                    name="book_title"
                    id="book_title"
                    class="form-control @error('book_title') is-invalid @enderror"
                    value="{{ old('book_title', $book->book_title) }}"
                    maxlength="255"
                    required
                >

                @error('book_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>

                    <select
                        name="category_id"
                        id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="author_id" class="form-label">Author</label>

                    <select
                        name="author_id"
                        id="author_id"
                        class="form-select @error('author_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Select an author</option>

                        @foreach ($authors as $author)
                            <option
                                value="{{ $author->id }}"
                                {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}
                            >
                                {{ $author->first_name }} {{ $author->last_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('author_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price (₱)</label>

                    <input
                        type="number"
                        name="price"
                        id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price', $book->price) }}"
                        min="0"
                        max="99999999.99"
                        step="0.01"
                        required
                    >

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stock_quantity" class="form-label">Stock Quantity</label>

                    <input
                        type="number"
                        name="stock_quantity"
                        id="stock_quantity"
                        class="form-control @error('stock_quantity') is-invalid @enderror"
                        value="{{ old('stock_quantity', $book->stock_quantity) }}"
                        min="0"
                        step="1"
                        required
                    >

                    @error('stock_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update Book
                </button>

                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('app')

@section('title', 'Add Category - Online Book Store')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        &larr; Back to Categories
    </a>

    <h2 class="page-title">Add New Category</h2>
    <p class="text-muted mb-0">
        Enter the details for the new book category.
    </p>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="category_name" class="form-label">
                    Category Name
                </label>

                <input
                    type="text"
                    name="category_name"
                    id="category_name"
                    class="form-control @error('category_name') is-invalid @enderror"
                    value="{{ old('category_name') }}"
                    maxlength="255"
                    required
                >

                @error('category_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="4"
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">
                    Icon or Symbol (Optional)
                </label>

                <input
                    type="text"
                    name="icon"
                    id="icon"
                    class="form-control @error('icon') is-invalid @enderror"
                    value="{{ old('icon') }}"
                    maxlength="255"
                    placeholder="Example: 📚"
                >

                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    You can enter an emoji or a short text symbol.
                </small>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="form-select @error('status') is-invalid @enderror"
                    required
                >
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>

                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Save Category
                </button>

                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


@extends('app')

@section('title', 'Categories - Online Book Store')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">Categories</h2>
        <p class="text-muted mb-0">
            Organize books by category.
        </p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        + Add Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($categories->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Books</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->description ?: '—' }}</td>
                                <td>{{ $category->icon ?: '—' }}</td>
                                <td>
                                    @if ($category->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $category->books()->count() }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a
                                            href="{{ route('categories.show', $category) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('categories.edit', $category) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('categories.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                {{ $category->books()->exists() ? 'disabled title=This-category-has-books' : '' }}
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
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <h5>No categories found</h5>
                <p class="text-muted">
                    Create a category before adding books.
                </p>

                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    Add First Category
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

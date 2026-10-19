@extends('app')

@section('title', 'Authors - Online Book Store')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">Authors</h2>
        <p class="text-muted mb-0">
            Manage book authors and their information.
        </p>
    </div>

    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        + Add Author
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($authors->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Author Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Books</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>
                                    {{ trim($author->first_name . ' ' . $author->last_name) }}
                                </td>

                                <td>{{ $author->email ?? 'N/A' }}</td>

                                <td>{{ $author->address ?? 'N/A' }}</td>

                                <td>{{ $author->books()->count() }}</td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a
                                            href="{{ route('authors.show', $author) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('authors.edit', $author) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('authors.destroy', $author) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this author?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                @if ($author->books()->exists())
                                                    disabled
                                                    title="This author has books and cannot be deleted."
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
                {{ $authors->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <h5>No authors found</h5>
                <p class="text-muted">
                    Add your first author to get started.
                </p>

                <a href="{{ route('authors.create') }}" class="btn btn-primary">
                    Add First Author
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

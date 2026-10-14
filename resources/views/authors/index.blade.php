@extends('app')

@section('title', 'Authors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Authors</h2>
        <p class="text-muted mb-0">Manage the authors of your books.</p>
    </div>

    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        Add Author
    </a>
</div>

@if ($authors->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Books</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>
                                {{ $author->first_name }}
                                {{ $author->last_name }}
                            </td>

                            <td>{{ $author->email ?? 'N/A' }}</td>

                            <td>{{ $author->address ?? 'N/A' }}</td>

                            <td>{{ $author->books()->count() }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('authors.show', $author) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('authors.edit', $author) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('authors.destroy', $author) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this author?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                @if ($author->books()->exists())
                                                    disabled
                                                    title="This author has books and cannot be deleted."
                                                @endif>
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
    </div>

    <div class="mt-3">
        {{ $authors->links() }}
    </div>
@else
    <div class="alert alert-info">
        No authors have been added yet. Click <strong>Add Author</strong>
        to register your first author.
    </div>
@endif
@endsection

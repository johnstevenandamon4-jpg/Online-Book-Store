@extends('app')

@section('title', 'Edit Author')

@section('content')
<div class="mb-4">
    <h2>Edit Author</h2>
    <p class="text-muted">Update the author's information below.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('authors.update', $author) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">
                        First Name
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name', $author->first_name) }}"
                        required
                    >

                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">
                        Last Name
                    </label>

                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name', $author->last_name) }}"
                        required
                    >

                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $author->email) }}"
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">
                    Address
                </label>

                <textarea
                    name="address"
                    id="address"
                    rows="3"
                    class="form-control @error('address') is-invalid @enderror"
                >{{ old('address', $author->address) }}</textarea>

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update Author
                </button>

                <a href="{{ route('authors.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

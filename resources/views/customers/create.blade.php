@extends('app')

@section('title', 'Add Customer')

@section('content')
<div class="mb-4">
    <h2>Add Customer</h2>
    <p class="text-muted">Register a new customer for the bookstore.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="full_name" class="form-label">
                    Full Name
                </label>

                <input
                    type="text"
                    name="full_name"
                    id="full_name"
                    class="form-control @error('full_name') is-invalid @enderror"
                    value="{{ old('full_name') }}"
                    required
                >

                @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contact_number" class="form-label">
                    Contact Number
                </label>

                <input
                    type="text"
                    name="contact_number"
                    id="contact_number"
                    class="form-control @error('contact_number') is-invalid @enderror"
                    value="{{ old('contact_number') }}"
                >

                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="shipping_address" class="form-label">
                    Shipping Address
                </label>

                <textarea
                    name="shipping_address"
                    id="shipping_address"
                    rows="3"
                    class="form-control @error('shipping_address') is-invalid @enderror"
                    required
                >{{ old('shipping_address') }}</textarea>

                @error('shipping_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Save Customer
                </button>

                <a href="{{ route('customers.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

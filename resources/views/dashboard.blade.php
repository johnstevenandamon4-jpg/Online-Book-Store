@extends('app')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Online Book Store Management System</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-2">
            <i class="bi bi-book"></i> Browse Books
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Books</p>
                        <h2 class="fw-bold mb-0">{{ $stats['books'] }}</h2>
                    </div>
                    <i class="bi bi-book display-5 text-primary"></i>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('books.index') }}" class="text-decoration-none">Manage Books →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Categories</p>
                        <h2 class="fw-bold mb-0">{{ $stats['categories'] }}</h2>
                    </div>
                    <i class="bi bi-tags display-5 text-success"></i>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('categories.index') }}" class="text-decoration-none">Manage Categories →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Authors</p>
                        <h2 class="fw-bold mb-0">{{ $stats['authors'] }}</h2>
                    </div>
                    <i class="bi bi-person-lines-fill display-5 text-warning"></i>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('authors.index') }}" class="text-decoration-none">Manage Authors →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Customers</p>
                        <h2 class="fw-bold mb-0">{{ $stats['customers'] }}</h2>
                    </div>
                    <i class="bi bi-people display-5 text-info"></i>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('customers.index') }}" class="text-decoration-none">Manage Customers →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Orders</p>
                        <h2 class="fw-bold mb-0">{{ $stats['orders'] }}</h2>
                    </div>
                    <i class="bi bi-cart-check display-5 text-danger"></i>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('orders.index') }}" class="text-decoration-none">Manage Orders →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Quick Actions</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('books.create') }}" class="btn btn-outline-primary">+ Add Book</a>
                <a href="{{ route('categories.create') }}" class="btn btn-outline-success">+ Add Category</a>
                <a href="{{ route('authors.create') }}" class="btn btn-outline-warning">+ Add Author</a>
                <a href="{{ route('customers.create') }}" class="btn btn-outline-info">+ Add Customer</a>
                <a href="{{ route('orders.create') }}" class="btn btn-outline-danger">+ Add Order</a>
            </div>
        </div>
    </div>
</div>
@endsection

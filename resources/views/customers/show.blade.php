@extends('app')

@section('title', 'Customer Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Customer Details</h2>
        <p class="text-muted mb-0">
            View customer information and order history.
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('customers.edit', $customer) }}"
           class="btn btn-warning">
            Edit Customer
        </a>

        <a href="{{ route('customers.index') }}"
           class="btn btn-secondary">
            Back to Customers
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Customer Information</h5>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Full Name</div>
            <div class="col-md-8">{{ $customer->full_name }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Email Address</div>
            <div class="col-md-8">{{ $customer->email }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Contact Number</div>
            <div class="col-md-8">
                {{ $customer->contact_number ?? 'Not provided' }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Shipping Address</div>
            <div class="col-md-8">{{ $customer->shipping_address }}</div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4 fw-bold">Total Orders</div>
            <div class="col-md-8">{{ $customer->orders->count() }}</div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Order History</h5>
    </div>

    <div class="card-body">
        @if ($customer->orders->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Book</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($customer->orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>

                                <td>
                                    {{ $order->book->book_title }}
                                </td>

                                <td>{{ $order->quantity }}</td>

                                <td>
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $order->order_status }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('orders.show', $order) }}"
                                       class="btn btn-sm btn-info">
                                        View Order
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mb-0">
                This customer has no orders yet.
            </p>
        @endif
    </div>
</div>
@endsection

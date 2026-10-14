@extends('app')

@section('title', 'Order Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Order #{{ $order->id }}</h2>
        <p class="text-muted mb-0">
            View order details, customer information, and payment status.
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('orders.edit', $order) }}"
           class="btn btn-warning">
            Edit Order
        </a>

        <a href="{{ route('orders.index') }}"
           class="btn btn-secondary">
            Back to Orders
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Order Information</h5>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Order ID</div>
            <div class="col-md-8">#{{ $order->id }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Order Date</div>
            <div class="col-md-8">
                {{ $order->created_at->format('F d, Y h:i A') }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Last Updated</div>
            <div class="col-md-8">
                {{ $order->updated_at->format('F d, Y h:i A') }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Order Status</div>
            <div class="col-md-8">
                @php
                    $statusClass = match ($order->order_status) {
                        'Pending' => 'bg-warning text-dark',
                        'Processing' => 'bg-info text-dark',
                        'Completed' => 'bg-success',
                        'Cancelled' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp

                <span class="badge {{ $statusClass }}">
                    {{ $order->order_status }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Customer Information</h5>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Customer Name</div>
            <div class="col-md-8">
                {{ $order->customer->full_name }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Email Address</div>
            <div class="col-md-8">
                {{ $order->customer->email }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Contact Number</div>
            <div class="col-md-8">
                {{ $order->customer->contact_number ?? 'Not provided' }}
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4 fw-bold">Shipping Address</div>
            <div class="col-md-8">
                {{ $order->customer->shipping_address }}
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('customers.show', $order->customer) }}"
               class="btn btn-sm btn-info">
                View Customer
            </a>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Book and Payment Details</h5>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Book Title</div>
            <div class="col-md-8">
                {{ $order->book->book_title }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Category</div>
            <div class="col-md-8">
                {{ $order->book->category->category_name }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Price per Book</div>
            <div class="col-md-8">
                ₱{{ number_format($order->book->price, 2) }}
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Quantity</div>
            <div class="col-md-8">{{ $order->quantity }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Payment Type</div>
            <div class="col-md-8">{{ $order->payment_type }}</div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4 fw-bold">Total Amount</div>
            <div class="col-md-8">
                <h4 class="text-success mb-0">
                    ₱{{ number_format($order->total_amount, 2) }}
                </h4>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('books.show', $order->book) }}"
               class="btn btn-sm btn-info">
                View Book
            </a>
        </div>
    </div>
</div>
@endsection

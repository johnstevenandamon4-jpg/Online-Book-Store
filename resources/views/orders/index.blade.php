@extends('app')

@section('title', 'Orders - Online Book Store')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">Orders</h2>
        <p class="text-muted mb-0">
            Manage customer book orders and their statuses.
        </p>
    </div>

    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        + Create Order
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if ($orders->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Book</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ $order->customer->full_name }}</td>
                                <td>{{ $order->book->book_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ $order->payment_type }}</td>

                                <td>
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
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a
                                            href="{{ route('orders.show', $order) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('orders.edit', $order) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('orders.destroy', $order) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
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
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <h5>No orders found</h5>
                <p class="text-muted">
                    Create your first order to get started.
                </p>

                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                    Create First Order
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('app')

@section('title', 'Edit Order')

@section('content')
<div class="mb-4">
    <h2>Edit Order #{{ $order->id }}</h2>
    <p class="text-muted">
        Update the customer's order information.
    </p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_id" class="form-label">
                    Customer
                </label>

                <select
                    name="customer_id"
                    id="customer_id"
                    class="form-select @error('customer_id') is-invalid @enderror"
                    required
                >
                    <option value="">Select a customer</option>

                    @foreach ($customers as $customer)
                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}
                        >
                            {{ $customer->full_name }}
                            ({{ $customer->email }})
                        </option>
                    @endforeach
                </select>

                @error('customer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="book_id" class="form-label">
                    Book
                </label>

                <select
                    name="book_id"
                    id="book_id"
                    class="form-select @error('book_id') is-invalid @enderror"
                    required
                >
                    <option value="">Select a book</option>

                    @foreach ($books as $book)
                        <option
                            value="{{ $book->id }}"
                            {{ old('book_id', $order->book_id) == $book->id ? 'selected' : '' }}
                            {{ $book->stock_quantity < 1 && $book->id != $order->book_id ? 'disabled' : '' }}
                        >
                            {{ $book->book_title }}
                            — ₱{{ number_format($book->price, 2) }}
                            (Available stock: {{ $book->stock_quantity }})
                        </option>
                    @endforeach
                </select>

                @error('book_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">
                    Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    min="1"
                    class="form-control @error('quantity') is-invalid @enderror"
                    value="{{ old('quantity', $order->quantity) }}"
                    required
                >

                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="payment_type" class="form-label">
                    Payment Type
                </label>

                <select
                    name="payment_type"
                    id="payment_type"
                    class="form-select @error('payment_type') is-invalid @enderror"
                    required
                >
                    @foreach (['Cash on Delivery', 'GCash', 'Bank Transfer'] as $payment)
                        <option
                            value="{{ $payment }}"
                            {{ old('payment_type', $order->payment_type) === $payment ? 'selected' : '' }}
                        >
                            {{ $payment }}
                        </option>
                    @endforeach
                </select>

                @error('payment_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order_status" class="form-label">
                    Order Status
                </label>

                <select
                    name="order_status"
                    id="order_status"
                    class="form-select @error('order_status') is-invalid @enderror"
                    required
                >
                    @foreach (['Pending', 'Processing', 'Completed', 'Cancelled'] as $status)
                        <option
                            value="{{ $status }}"
                            {{ old('order_status', $order->order_status) === $status ? 'selected' : '' }}
                        >
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

                @error('order_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info">
                The total amount is recalculated automatically using
                the selected book's price and the order quantity.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update Order
                </button>

                <a href="{{ route('orders.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

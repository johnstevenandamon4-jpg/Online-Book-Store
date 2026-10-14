@extends('app')

@section('title', 'Customers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Customers</h2>
        <p class="text-muted mb-0">
            Manage customer information and shipping details.
        </p>
    </div>

    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        Add Customer
    </a>
</div>

@if ($customers->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Orders</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->full_name }}</td>

                            <td>{{ $customer->email }}</td>

                            <td>
                                {{ $customer->contact_number ?? 'N/A' }}
                            </td>

                            <td>{{ $customer->orders()->count() }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('customers.show', $customer) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('customers.edit', $customer) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('customers.destroy', $customer) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                @if ($customer->orders()->exists())
                                                    disabled
                                                    title="This customer has orders and cannot be deleted."
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
        {{ $customers->links() }}
    </div>
@else
    <div class="alert alert-info">
        No customers have been registered yet.
        Click <strong>Add Customer</strong> to register your first customer.
    </div>
@endif
@endsection

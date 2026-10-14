<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:1000'],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load('orders');

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($customer->id),
            ],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:1000'],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->orders()->exists()) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Cannot delete a customer who has existing orders.');
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}

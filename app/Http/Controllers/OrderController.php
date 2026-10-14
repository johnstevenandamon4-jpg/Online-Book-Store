<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'book'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('full_name')->get();

        $books = Book::where('stock_quantity', '>', 0)
            ->orderBy('book_title')
            ->get();

        return view('orders.create', compact('customers', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            'book_id' => [
                'required',
                'integer',
                'exists:books,id',
            ],
            'quantity' => ['required', 'integer', 'min:1'],
            'payment_type' => [
                'required',
                Rule::in([
                    'Cash on Delivery',
                    'GCash',
                    'Bank Transfer',
                ]),
            ],
            'order_status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Processing',
                    'Completed',
                    'Cancelled',
                ]),
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $book = Book::whereKey($validated['book_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $isCancelled = $validated['order_status'] === 'Cancelled';

            if (
                !$isCancelled &&
                $book->stock_quantity < $validated['quantity']
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => 'Not enough stock available for this book.',
                ]);
            }

            $validated['total_amount'] =
                $book->price * $validated['quantity'];

            Order::create($validated);

            if (!$isCancelled) {
                $book->decrement(
                    'stock_quantity',
                    $validated['quantity']
                );
            }
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'book']);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::orderBy('full_name')->get();

        $books = Book::where(function ($query) use ($order) {
            $query->where('stock_quantity', '>', 0)
                ->orWhere('id', $order->book_id);
        })->orderBy('book_title')->get();

        return view('orders.edit', compact('order', 'customers', 'books'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            'book_id' => [
                'required',
                'integer',
                'exists:books,id',
            ],
            'quantity' => ['required', 'integer', 'min:1'],
            'payment_type' => [
                'required',
                Rule::in([
                    'Cash on Delivery',
                    'GCash',
                    'Bank Transfer',
                ]),
            ],
            'order_status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Processing',
                    'Completed',
                    'Cancelled',
                ]),
            ],
        ]);

        DB::transaction(function () use ($validated, $order) {
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldBookId = $lockedOrder->book_id;
            $newBookId = (int) $validated['book_id'];

            $oldBook = Book::whereKey($oldBookId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($newBookId === (int) $oldBookId) {
                $newBook = $oldBook;
            } else {
                $newBook = Book::whereKey($newBookId)
                    ->lockForUpdate()
                    ->firstOrFail();
            }

            $oldConsumesStock =
                $lockedOrder->order_status !== 'Cancelled';

            $newConsumesStock =
                $validated['order_status'] !== 'Cancelled';

            $availableStock = $newBook->stock_quantity;

            if (
                $oldConsumesStock &&
                $newBookId === (int) $oldBookId
            ) {
                $availableStock += $lockedOrder->quantity;
            }

            if (
                $newConsumesStock &&
                $availableStock < $validated['quantity']
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' =>
                        'Not enough stock available for the selected book.',
                ]);
            }

            $validated['total_amount'] =
                $newBook->price * $validated['quantity'];

            if ($oldConsumesStock) {
                $oldBook->increment(
                    'stock_quantity',
                    $lockedOrder->quantity
                );
            }

            if ($newConsumesStock) {
                $newBook->decrement(
                    'stock_quantity',
                    $validated['quantity']
                );
            }

            $lockedOrder->update($validated);
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) {
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $book = Book::whereKey($lockedOrder->book_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedOrder->order_status !== 'Cancelled') {
                $book->increment(
                    'stock_quantity',
                    $lockedOrder->quantity
                );
            }

            $lockedOrder->delete();
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}

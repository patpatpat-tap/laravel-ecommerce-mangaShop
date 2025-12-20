<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders (unless admin)
        if (!Auth::user()->is_admin && $order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'user');
        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = Auth::user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        // Check stock availability
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')
                    ->with('error', "Insufficient stock for {$item->product->name}!");
            }
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Auth::user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'shipping_city' => ['required', 'string', 'max:255'],
            'shipping_state' => ['nullable', 'string', 'max:255'],
            'shipping_postal_code' => ['required', 'string', 'max:20'],
            'shipping_country' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
        ]);

        // Check stock again before creating order
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')
                    ->with('error', "Insufficient stock for {$item->product->name}!");
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => $cart->total_price,
            'status' => 'pending',
            ...$validated,
        ]);

        // Create order items and update stock
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'qa_status' => 'pending', // Default QA status
            ]);

            // Update product stock
            $item->product->decrement('stock', $item->quantity);
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,ready_to_ship,shipped,completed,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated!');
    }

    public function updateQAStatus(Request $request, OrderItem $orderItem)
    {
        // Only admins can update QA status
        if (!Auth::user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'qa_status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $orderItem->update(['qa_status' => $request->qa_status]);

        return response()->json([
            'success' => true,
            'message' => 'QA status updated successfully',
            'qa_status' => $orderItem->qa_status
        ]);
    }
}

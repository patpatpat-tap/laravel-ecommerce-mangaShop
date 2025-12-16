<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $product->stock],
        ]);

        $cart = $this->getOrCreateCart();

        // Check if item already exists in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available!'
                    ], 422);
                }
                return back()->with('error', 'Not enough stock available!');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        // Refresh cart to get updated count
        $cart->refresh();
        $cartCount = $cart->items->sum('quantity');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => $cartCount
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $cartItem->product->stock],
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return back()->with('success', 'Cart cleared!');
    }

    private function getOrCreateCart()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        return $cart;
    }
}

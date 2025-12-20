@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<style>
    .cart-page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    .cart-header {
        margin-bottom: 2.5rem;
    }
    .cart-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        opacity: 0.85;
    }
    .cart-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .cart-item {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }
    .cart-item:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    .cart-item-image {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        flex-shrink: 0;
        overflow: hidden;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cart-item-details h3 {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        opacity: 0.8;
    }
    .cart-item-details p {
        font-size: 1rem;
        color: var(--text-light);
        margin-bottom: 0.75rem;
        opacity: 0.8;
        font-weight: 400;
    }
    .order-summary-item {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .order-summary-item:last-of-type {
        border-bottom: none;
    }
    .quantity-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed !important;
        background: #f3f4f6 !important;
    }
    .quantity-input:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background: #f9fafb;
    }
</style>

<div class="cart-page-container">
    <div class="cart-header">
        <h1 class="cart-title">Shopping Cart</h1>
        <p class="cart-subtitle">Review your selected mangas before checkout.</p>
    </div>

    @if($cart->items->count() > 0)
        @php
            $subtotal = $cart->total_price;
            $discount = 0;
            $delivery_fee = 0;
            $total = $subtotal - $discount + $delivery_fee;
        @endphp

        <div class="grid lg:grid-cols-3 gap-8 items-start">
            <!-- Left: Cart items -->
            <div class="lg:col-span-2">
                @foreach($cart->items as $item)
                    <div class="cart-item">
                        <div class="flex items-center gap-6">
                            <!-- Manga Image -->
                            <div class="cart-item-image">
                                @if($item->product?->image)
                                    <img
                                        src="{{ $item->product->image }}"
                                        alt="{{ $item->product->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-teal-400 text-3xl font-bold">
                                        {{ mb_substr($item->product?->name ?? 'MG', 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Manga Details -->
                            <div class="flex-1 min-w-0 cart-item-details">
                                <h3>{{ $item->product?->name }}</h3>
                                <p>
                                    {{ $item->product?->author }}
                                    {!! $item->product?->publisher ? ' · '.$item->product->publisher : '' !!}
                                </p>

                                @if($item->product?->category)
                                    <span class="inline-block px-3 py-1 bg-teal-100 text-teal-700 text-sm font-medium rounded-full">
                                        {{ $item->product->category->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Quantity, Price, and Delete -->
                            <div class="flex items-center gap-4" style="min-width: 250px;">
                                <div class="text-right flex-1">
                                    <!-- Quantity Controls -->
                                    <div class="mb-3">
                                        <div class="text-sm mb-1.5" style="font-weight: 400; color: var(--text-light); opacity: 0.85;">Quantity</div>
                                        <div class="flex items-center justify-end gap-2">
                                            <button type="button" 
                                                    class="quantity-btn quantity-decrease"
                                                    data-item-id="{{ $item->id }}"
                                                    data-current-qty="{{ $item->quantity }}"
                                                    data-min="1"
                                                    style="width: 32px; height: 32px; border: 1px solid #e5e7eb; border-radius: 6px; background: white; color: #6b7280; font-size: 18px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; user-select: none;"
                                                    onmouseover="if(!this.disabled) { this.style.borderColor='#d1d5db'; this.style.color='#374151'; }"
                                                    onmouseout="if(!this.disabled) { this.style.borderColor='#e5e7eb'; this.style.color='#6b7280'; }">
                                                −
                                            </button>
                                            <input type="number" 
                                                   class="quantity-input"
                                                   data-item-id="{{ $item->id }}"
                                                   data-current-qty="{{ $item->quantity }}"
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock }}"
                                                   style="width: 60px; height: 32px; border: 1px solid #e5e7eb; border-radius: 6px; text-align: center; font-size: 14px; font-weight: 500; color: var(--text-dark); transition: all 0.2s;"
                                                   onchange="updateQuantity({{ $item->id }}, this.value)"
                                                   onblur="if(this.value < 1) { this.value = 1; updateQuantity({{ $item->id }}, 1); } else if(this.value > {{ $item->product->stock }}) { this.value = {{ $item->product->stock }}; updateQuantity({{ $item->id }}, {{ $item->product->stock }}); }">
                                            <button type="button" 
                                                    class="quantity-btn quantity-increase"
                                                    data-item-id="{{ $item->id }}"
                                                    data-current-qty="{{ $item->quantity }}"
                                                    data-max="{{ $item->product->stock }}"
                                                    style="width: 32px; height: 32px; border: 1px solid #e5e7eb; border-radius: 6px; background: white; color: #6b7280; font-size: 18px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; user-select: none;"
                                                    onmouseover="if(!this.disabled) { this.style.borderColor='#d1d5db'; this.style.color='#374151'; }"
                                                    onmouseout="if(!this.disabled) { this.style.borderColor='#e5e7eb'; this.style.color='#6b7280'; }">
                                                +
                                            </button>
                                        </div>
                                        <div class="text-xs mt-1" style="color: var(--text-light); opacity: 0.7;">
                                            Max: {{ $item->product->stock }}
                                        </div>
                                    </div>
                                    
                                    <div class="text-base mb-3" style="font-weight: 400; color: var(--text-light); opacity: 0.85;">
                                        ₱{{ number_format($item->price, 2) }} each
                                    </div>
                                    <div class="text-2xl item-subtotal" data-item-id="{{ $item->id }}" style="color: var(--gold); font-weight: 500; opacity: 1;">
                                        ₱{{ number_format($item->subtotal, 2) }}
                                    </div>
                                </div>
                                
                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove', $item) }}" method="POST" class="flex-shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition-colors duration-200 p-2 rounded-lg hover:bg-red-50"
                                            onclick="return confirm('Remove this manga from cart?')"
                                            style="font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl mb-6" style="font-family: 'Poppins', 'Inter', sans-serif; font-weight: 500; color: var(--text-dark); opacity: 0.85;">Order Summary</h2>

                    <!-- Price Breakdown -->
                    <div class="mb-6">
                        <div class="order-summary-item flex justify-between items-center">
                            <span style="font-size: 1rem; font-weight: 400; color: var(--text-light); opacity: 0.85;">Subtotal</span>
                            <span class="cart-subtotal" style="font-size: 1rem; font-weight: 500; color: var(--text-dark); opacity: 0.9;">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="order-summary-item flex justify-between items-center">
                            <span style="font-size: 1rem; font-weight: 400; color: var(--text-light); opacity: 0.85;">Discount</span>
                            <span style="font-size: 1rem; font-weight: 500; color: #10b981; opacity: 1;">-₱{{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="order-summary-item flex justify-between items-center">
                            <span style="font-size: 1rem; font-weight: 400; color: var(--text-light); opacity: 0.85;">Delivery Fee</span>
                            <span style="font-size: 1rem; font-weight: 500; color: var(--text-dark); opacity: 0.9;">₱{{ number_format($delivery_fee, 2) }}</span>
                        </div>
                        <hr class="border-gray-200 my-4" style="border-width: 1px; opacity: 0.4;">
                        <div class="flex justify-between items-center pt-2">
                            <span style="font-size: 1.25rem; font-weight: 500; color: var(--text-dark); opacity: 0.95;">Total</span>
                            <span class="cart-total" style="font-size: 1.25rem; font-weight: 500; color: var(--text-dark); opacity: 0.95;">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout') }}"
                       class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition-all duration-200 hover:scale-105">
                        <i class="fas fa-credit-card mr-2"></i>Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
            <p class="text-gray-500 text-xl mb-6" style="font-family: 'Poppins', 'Inter', sans-serif; font-weight: 500;">Your cart is empty.</p>
            <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 inline-block font-semibold transition-all duration-200 hover:scale-105" style="font-family: 'Poppins', 'Inter', sans-serif;">
                Start Shopping
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Update quantity function
    function updateQuantity(itemId, newQuantity) {
        const quantityInput = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
        const decreaseBtn = document.querySelector(`.quantity-decrease[data-item-id="${itemId}"]`);
        const increaseBtn = document.querySelector(`.quantity-increase[data-item-id="${itemId}"]`);
        const maxStock = parseInt(increaseBtn.getAttribute('data-max')) || 999;
        const originalQty = parseInt(quantityInput.getAttribute('data-current-qty')) || 1;
        
        // Validate quantity
        let qty = parseInt(newQuantity);
        if (isNaN(qty) || qty < 1) {
            qty = 1;
        }
        if (qty > maxStock) {
            qty = maxStock;
            alert(`Maximum stock available: ${maxStock}`);
        }
        
        // Don't update if quantity hasn't changed
        if (qty === originalQty && parseInt(quantityInput.value) === originalQty) {
            return;
        }
        
        // Update input value
        quantityInput.value = qty;
        
        // Disable buttons during request
        decreaseBtn.disabled = true;
        increaseBtn.disabled = true;
        quantityInput.disabled = true;
        
        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Send AJAX request
        fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                quantity: qty
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Failed to update quantity');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update item subtotal
                const itemSubtotal = document.querySelector(`.item-subtotal[data-item-id="${itemId}"]`);
                if (itemSubtotal && data.item) {
                    itemSubtotal.textContent = `₱${data.item.subtotal}`;
                }
                
                // Update cart subtotal and total
                const cartSubtotal = document.querySelector('.cart-subtotal');
                const cartTotal = document.querySelector('.cart-total');
                if (cartSubtotal && data.cart) {
                    cartSubtotal.textContent = `₱${data.cart.subtotal}`;
                }
                if (cartTotal && data.cart) {
                    cartTotal.textContent = `₱${data.cart.total}`;
                }
                
                // Update stored current quantity
                quantityInput.setAttribute('data-current-qty', qty);
            } else {
                throw new Error(data.message || 'Failed to update quantity');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'An error occurred while updating quantity');
            // Revert input value to original
            quantityInput.value = originalQty;
        })
        .finally(() => {
            // Re-enable buttons
            decreaseBtn.disabled = false;
            increaseBtn.disabled = false;
            quantityInput.disabled = false;
        });
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Handle decrease button click
        document.querySelectorAll('.quantity-decrease').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                const itemId = this.getAttribute('data-item-id');
                const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                const currentQty = parseInt(input.value) || 1;
                const newQty = Math.max(1, currentQty - 1);
                updateQuantity(itemId, newQty);
            });
        });
        
        // Handle increase button click
        document.querySelectorAll('.quantity-increase').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                const itemId = this.getAttribute('data-item-id');
                const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                const maxStock = parseInt(this.getAttribute('data-max')) || 999;
                const currentQty = parseInt(input.value) || 1;
                const newQty = Math.min(maxStock, currentQty + 1);
                
                if (newQty > maxStock) {
                    alert(`Maximum stock available: ${maxStock}`);
                    return;
                }
                
                updateQuantity(itemId, newQty);
            });
        });
        
        // Store initial quantity for each input
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.setAttribute('data-current-qty', input.value);
        });
    });
</script>
@endpush

@endsection


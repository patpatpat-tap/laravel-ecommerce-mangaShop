@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<style>
    .checkout-page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    .checkout-header {
        margin-bottom: 2.5rem;
    }
    .checkout-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        opacity: 0.85;
    }
    .checkout-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .checkout-section {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .checkout-section h2 {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.85;
        margin-bottom: 1.5rem;
    }
    .form-label {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
        margin-bottom: 0.5rem;
    }
    .form-input, .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        font-size: 1rem;
        color: var(--text-dark);
        opacity: 0.9;
        transition: all 0.2s;
    }
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    .order-item-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    .order-item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        flex-shrink: 0;
        overflow: hidden;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .order-item-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0.25rem;
    }
    .order-item-details {
        font-size: 0.95rem;
        color: var(--text-light);
        opacity: 0.75;
    }
    .order-summary-item {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .order-summary-item:last-of-type {
        border-bottom: none;
    }
</style>

@php
    $subtotal     = $cart->total_price;
    $discount     = 0;
    $delivery_fee = 0;
    $total        = $subtotal - $discount + $delivery_fee;
@endphp

<div class="checkout-page-container">
    <!-- Header -->
    <div class="checkout-header">
        <div>
            <h1 class="checkout-title">Checkout</h1>
            <p class="checkout-subtitle">
                Complete your order and get your mangas delivered
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Delivery info + order items -->
        <div class="lg:col-span-2">
            <!-- Delivery Information -->
            <div class="checkout-section">
                <h2>
                    <i class="fas fa-truck mr-2" style="color: var(--gold); opacity: 0.9;"></i>Delivery Information
                </h2>

                <form id="checkout-form"
                      action="{{ route('orders.store') }}"
                      method="POST"
                      class="space-y-5">
                    @csrf

                    <div>
                        <label class="form-label block">
                            Delivery Address *
                        </label>
                        <textarea
                            name="shipping_address"
                            required
                            placeholder="Enter your complete delivery address..."
                            rows="3"
                            class="form-textarea">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label block">
                                City *
                            </label>
                            <input
                                type="text"
                                name="shipping_city"
                                value="{{ old('shipping_city') }}"
                                required
                                placeholder="City / Province"
                                class="form-input">
                            @error('shipping_city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label block">
                                Postal Code *
                            </label>
                            <input
                                type="text"
                                name="shipping_postal_code"
                                value="{{ old('shipping_postal_code') }}"
                                required
                                placeholder="Postal code"
                                class="form-input">
                            @error('shipping_postal_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label block">
                                Country *
                            </label>
                            <input
                                type="text"
                                name="shipping_country"
                                value="{{ old('shipping_country') }}"
                                required
                                placeholder="Country"
                                class="form-input">
                            @error('shipping_country')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label block">
                                Contact Phone *
                            </label>
                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                placeholder="Your phone number"
                                class="form-input">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <label class="form-label block">
                            Delivery Instructions
                        </label>
                        <input
                            type="text"
                            name="notes"
                            value="{{ old('notes') }}"
                            placeholder="Any special instructions?"
                            class="form-input">
                    </div>

                    <div style="background: rgba(212, 175, 55, 0.1); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 12px; padding: 1.25rem; margin-top: 0;">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle mt-1 mr-3" style="color: var(--gold); opacity: 0.9;"></i>
                            <div style="font-size: 0.9rem; color: var(--text-light); opacity: 0.85;">
                                <p style="font-weight: 500; margin-bottom: 0.5rem;">Delivery Information</p>
                                <p>
                                    We'll deliver your mangas to your specified address.
                                    Our delivery team will contact you when they're on the way.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Items (Manga) -->
            <div class="checkout-section">
                <h2>
                    <i class="fas fa-shopping-bag mr-2" style="color: var(--gold); opacity: 0.9;"></i>Order Items
                </h2>

                <div>
                    @foreach($cart->items as $item)
                        <div class="order-item-card flex items-center gap-4">
                            <!-- Manga Image -->
                            <div class="order-item-image">
                                @if($item->product?->image)
                                    <img src="{{ $item->product->image }}"
                                         alt="{{ $item->product->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-teal-400 text-2xl font-bold">
                                        {{ mb_substr($item->product?->name ?? 'MG', 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Manga Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="order-item-title">{{ $item->product?->name }}</h3>
                                <p class="order-item-details">
                                    {{ $item->product?->author }}
                                    {!! $item->product?->publisher ? ' · '.$item->product->publisher : '' !!}
                                </p>
                                <p class="order-item-details">Quantity: {{ $item->quantity }}</p>
                            </div>

                            <!-- Price -->
                            <div class="text-right" style="min-width: 120px;">
                                <div style="font-size: 0.95rem; color: var(--text-light); opacity: 0.75; margin-bottom: 0.5rem;">
                                    ₱{{ number_format($item->price, 2) }} each
                                </div>
                                <div style="font-size: 1.5rem; color: var(--gold); font-weight: 500; opacity: 0.9;">
                                    ₱{{ number_format($item->subtotal, 2) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                <h2 class="text-xl mb-6" style="font-family: 'Poppins', 'Inter', sans-serif; font-weight: 500; color: var(--text-dark); opacity: 0.85;">Order Summary</h2>

                <!-- Price Breakdown -->
                <div class="mb-6">
                    <div class="order-summary-item flex justify-between items-center">
                        <span style="font-size: 1rem; font-weight: 400; color: var(--text-light); opacity: 0.85;">Subtotal</span>
                        <span style="font-size: 1rem; font-weight: 500; color: var(--text-dark); opacity: 0.9;">₱{{ number_format($subtotal, 2) }}</span>
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
                        <span style="font-size: 1.25rem; font-weight: 500; color: var(--text-dark); opacity: 0.95;">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- Place Order Button -->
                <button type="submit" form="checkout-form"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold
                               py-3 px-4 rounded-lg transition-all duration-200 hover:scale-105"
                        style="font-family: 'Poppins', 'Inter', sans-serif;">
                    <i class="fas fa-credit-card mr-2"></i>Place Order
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


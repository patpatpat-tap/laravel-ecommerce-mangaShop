@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10" style="padding-top: 2rem;">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Shopping Cart</h1>
        <p class="text-sm text-gray-500">Review your selected mangas before checkout.</p>
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
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart->items as $item)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center gap-4">
                            <!-- Manga Image (adapted from medicine image UI) -->
                            <div class="w-20 h-20 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($item->product?->image)
                                    <img
                                        src="{{ $item->product->image }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover rounded-xl">
                                @else
                                    <div class="text-teal-400 text-2xl font-bold">
                                        {{ mb_substr($item->product?->name ?? 'MG', 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Manga Details (adapted from medicine details UI) -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                    {{ $item->product?->name }}
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    {{ $item->product?->author }}
                                    {!! $item->product?->publisher ? ' · '.$item->product->publisher : '' !!}
                                </p>

                                @if($item->product?->category)
                                    <span class="inline-block px-2 py-1 bg-teal-100 text-teal-700 text-xs font-medium rounded-full">
                                        {{ $item->product->category->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Quantity and Price (static, like reference UI) -->
                            <div class="text-right">
                                <div class="text-sm text-gray-500 mb-1">
                                    Quantity: {{ $item->quantity }}
                                </div>
                                <div class="text-sm text-gray-500 mb-2">
                                    ₱{{ number_format($item->price, 2) }} each
                                </div>
                                <div class="text-xl font-bold text-teal-600">
                                    ₱{{ number_format($item->subtotal, 2) }}
                                </div>
                            </div>

                            <!-- Remove Button with icon + confirm -->
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 transition-colors duration-200"
                                        onclick="return confirm('Remove this manga from cart?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right: Order Summary (integrated from reference design) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>

                    <!-- Price Breakdown -->
                    <div class="space-y-6 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Discount</span>
                            <span class="text-emerald-600">-₱{{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Delivery Fee</span>
                            <span>₱{{ number_format($delivery_fee, 2) }}</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="flex justify-between text-lg font-semibold text-gray-900">
                            <span>Total</span>
                            <span>₱{{ number_format($total, 2) }}</span>
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
        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">Your cart is empty.</p>
            <a href="{{ route('home') }}" class="px-6 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 inline-block">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection


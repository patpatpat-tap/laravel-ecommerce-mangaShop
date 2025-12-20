@extends('layouts.app')

@section('title', $product->name)

@section('content')
<style>
    .qty-wrap {
        display: inline-flex;
        align-items: center;
        border: 1px solid #cbd5e0;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }
    .qty-btn {
        width: 38px;
        height: 38px;
        border: none;
        background: #f8fafc;
        font-size: 1.1rem;
        cursor: pointer;
    }
    .qty-input {
        width: 48px;
        height: 38px;
        text-align: center;
        border: 1px solid #cbd5e0;
        border-top: 0;
        border-bottom: 0;
        outline: none;
    }
    .add-cart-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.9rem 1.2rem;
        background: #0d9a8c;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        box-shadow: 0 6px 14px rgba(13,154,140,0.18);
        cursor: pointer;
    }
    .page-spacer {
        height: 100px;
    }
</style>

<div class="page-spacer"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="grid md:grid-cols-2 gap-10 p-8">
            <div class="flex justify-center items-center bg-[#f9f7e7] rounded-xl p-4">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full max-h-[620px] object-contain rounded-lg bg-white">
                @else
                    <div class="w-full h-[520px] bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400 text-xl">No Image</span>
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full font-semibold">{{ $product->category->name }}</span>
                    @if($product->publisher)
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full">Publisher: {{ $product->publisher }}</span>
                    @endif
                </div>

                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>

                <div class="flex flex-wrap gap-4 text-gray-700">
                    @if($product->author)
                        <div><span class="font-semibold">Author:</span> {{ $product->author }}</div>
                    @endif
                    @if($product->pages)
                        <div><span class="font-semibold">Pages:</span> {{ $product->pages }}</div>
                    @endif
                </div>

                <div class="text-3xl font-black text-emerald-600">₱{{ number_format($product->price, 2) }}</div>

                @if($product->description)
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-gray-900">Description</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                <div class="text-md">
                    @if($product->stock > 0)
                        <span class="text-emerald-600 font-semibold">{{ $product->stock }} available</span>
                    @else
                        <span class="text-red-600 font-semibold">Out of Stock</span>
                    @endif
                </div>

                @auth
                    @if($product->stock > 0)
                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex flex-wrap items-center gap-4">
                                @csrf
                                <div class="flex items-center gap-3 text-sm font-medium text-gray-700">
                                    Quantity:
                                    <div class="qty-wrap">
                                        <button type="button" id="qty-minus" class="qty-btn">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="qty-input" />
                                        <button type="button" id="qty-plus" class="qty-btn">+</button>
                                    </div>
                                </div>
                                <button type="submit" class="add-cart-btn">
                                    <span style="font-size:1.05rem;">🛍</span> Add to Cart
                                </button>
                            </form>
                        </div>
                    @else
                        <button disabled class="px-6 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                @else
                    <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-emerald-700 font-semibold hover:underline">login</a> to add items to cart.</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const minus = document.getElementById('qty-minus');
        const plus = document.getElementById('qty-plus');
        const qty = document.getElementById('quantity');
        if (minus && plus && qty) {
            minus.addEventListener('click', () => {
                const val = Math.max(1, parseInt(qty.value || '1', 10) - 1);
                qty.value = val;
            });
            plus.addEventListener('click', () => {
                const max = parseInt(qty.getAttribute('max') || '9999', 10);
                const val = Math.min(max, parseInt(qty.value || '1', 10) + 1);
                qty.value = val;
            });
        }
    });
</script>
@endpush


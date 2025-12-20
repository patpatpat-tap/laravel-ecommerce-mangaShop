@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<style>
    .shop-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    .shop-header {
        margin-bottom: 2.5rem;
    }
    .shop-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        opacity: 0.85;
    }
    .shop-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .filters-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .filter-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--gold-outline);
        border-radius: 8px;
        font-size: 1rem;
        background-color: white;
        color: var(--text-dark);
        transition: all 0.2s;
    }
    .filter-input:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    .filter-button {
        padding: 0.75rem 1.5rem;
        background-color: var(--gold);
        color: var(--text-dark);
        border: 2px solid var(--gold-outline);
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-button:hover {
        background-color: var(--dark-gold);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .clear-button {
        padding: 0.75rem 1.5rem;
        background-color: #f3f4f6;
        color: var(--text-dark);
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .clear-button:hover {
        background-color: #e5e7eb;
    }
    .product-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .product-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    .product-info {
        padding: 1rem;
    }
    .product-name {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0.25rem;
    }
    .product-category {
        font-size: 0.875rem;
        color: var(--text-light);
        opacity: 0.75;
        margin-bottom: 0.25rem;
    }
    .product-author {
        font-size: 0.875rem;
        color: var(--text-light);
        opacity: 0.75;
        margin-bottom: 0.75rem;
    }
    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.75rem;
        gap: 0.5rem;
    }
    .product-price {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gold);
        opacity: 0.9;
        flex-shrink: 0;
    }
    .add-to-cart-btn {
        padding: 0.5rem 0.75rem;
        background-color: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .add-to-cart-btn:hover:not(:disabled) {
        background-color: #059669;
        transform: translateY(-1px);
    }
    .add-to-cart-btn:disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
    }
    .stock-warning {
        font-size: 0.75rem;
        margin-top: 0.5rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }
    .stock-warning.out {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
    .stock-warning.low {
        color: #f59e0b;
        background-color: rgba(245, 158, 11, 0.1);
    }
</style>

<div class="shop-container">
    <div class="shop-header">
        <h1 class="shop-title">Shop</h1>
        <p class="shop-subtitle">Discover your favorite manga collection</p>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <form method="GET" action="{{ route('home') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search manga..." class="filter-input">
            </div>
            <div class="min-w-[200px]">
                <select name="category" class="filter-input">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="filter-button">
                Filter
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('home') }}" class="clear-button">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}" class="product-card">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="product-image flex items-center justify-center">
                            <span style="color: var(--text-light); opacity: 0.5;">No Image</span>
                        </div>
                    @endif
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-category">{{ $product->category->name }}</p>
                        @if($product->author)
                            <p class="product-author">By {{ $product->author }}</p>
                        @endif
                        <div class="product-footer">
                            <span class="product-price">₱{{ number_format($product->price, 2) }}</span>
                            @auth
                                <form method="POST" action="{{ route('cart.add', $product) }}" class="inline" onclick="event.preventDefault(); event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-to-cart-btn" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            @endauth
                        </div>
                        @if($product->stock <= 0)
                            <p class="stock-warning out">Out of Stock</p>
                        @elseif($product->stock < 10)
                            <p class="stock-warning low">Only {{ $product->stock }} left!</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-xl shadow-lg">
            <p style="font-size: 1.125rem; color: var(--text-light); opacity: 0.85;">No products found.</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Add to Cart button clicks
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (this.disabled) return;
                
                const form = this.closest('form');
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart badge
                        const cartBadge = document.querySelector('.cart-badge');
                        if (cartBadge) {
                            cartBadge.textContent = data.cart_count;
                            cartBadge.style.display = data.cart_count > 0 ? 'flex' : 'none';
                        }
                        
                        // Show success notification
                        const notification = document.createElement('div');
                        notification.style.cssText = 'position: fixed; top: 100px; right: 20px; background: #10b981; color: white; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideIn 0.3s ease-out;';
                        notification.textContent = 'Added to cart!';
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.style.animation = 'slideOut 0.3s ease-out';
                            setTimeout(() => notification.remove(), 300);
                        }, 2000);
                    } else {
                        alert(data.message || 'Failed to add item to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        });
    });
</script>
<style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>
@endpush
@endsection


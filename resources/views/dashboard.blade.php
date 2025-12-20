@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .section-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2rem;
        font-weight: 600;
        color: var(--text-dark);
        opacity: 0.85;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        letter-spacing: -0.02em;
    }
    .view-all-link {
        font-size: 1rem;
        color: var(--gold);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }
    .view-all-link:hover {
        color: var(--dark-gold);
        text-decoration: underline;
    }
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
    }
    .best-sellers-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem;
    }
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .best-sellers-grid .product-card {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }
    .best-sellers-grid .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.18);
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .best-sellers-grid .product-image {
        height: 200px;
    }
    .product-image-placeholder {
        background: var(--light-beige);
    }
    .product-image-placeholder {
        width: 100%;
        height: 200px;
        background: var(--light-beige);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
    }
    .best-sellers-grid .product-image-placeholder {
        height: 200px;
    }
    .product-info {
        padding: 1rem;
    }
    .product-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0.25rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
    .product-price {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gold);
        opacity: 0.9;
    }
    .product-info .flex {
        flex-wrap: nowrap;
    }
    .add-to-cart-btn {
        background-color: #22c55e;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        font-size: 0.8125rem;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .add-to-cart-btn:hover {
        background-color: #16a34a;
    }
    .add-to-cart-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: #9ca3af;
    }
    .cart-icon {
        width: 16px;
        height: 16px;
    }
    .product-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .status-sold-out {
        background-color: rgba(239, 27, 49, 0.1);
        color: var(--red);
    }
    .status-available {
        background-color: rgba(212, 175, 55, 0.1);
        color: var(--dark-gold);
    }
    .status-preorder {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    .status-dot.sold-out {
        background-color: var(--red);
    }
    .status-dot.available {
        background-color: var(--dark-gold);
    }
    .status-dot.preorder {
        background-color: #3b82f6;
    }
    .no-products {
        text-align: center;
        padding: 3rem;
        color: var(--text-light);
        opacity: 0.85;
        font-size: 1.125rem;
        font-family: 'Poppins', 'Inter', sans-serif;
    }
    /* Add padding to content to account for fixed header */
    .dashboard-content {
        margin-top: 0;
        width: 100%;
        max-width: 100%;
        padding: 0;
    }
    
    /* Featured Section - Two Column Layout (30% / 70%) */
    .featured-heading {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2rem;
        font-weight: 600;
        color: var(--text-dark);
        opacity: 0.85;
        margin: 0 0 1.5rem 0;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        letter-spacing: -0.02em;
    }
    .featured-section {
        margin-top: 0.5rem;
        margin-bottom: 3.5rem;
        background: white;
        border-radius: 20px;
        padding: 2rem 2.5rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    .featured-container {
        display: grid;
        grid-template-columns: 35% 65%;
        gap: 2rem;
        align-items: start;
    }
    
    /* Left Column - Article */
    .featured-article {
        display: flex;
        flex-direction: column;
    }
    .featured-series-title {
        font-size: 1.875rem;
        font-weight: 900;
        color: var(--red);
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }
    .featured-series-subtitle {
        font-size: 0.95rem;
        color: var(--red);
        margin-bottom: 1.5rem;
        font-weight: 600;
        line-height: 1.4;
    }
    .featured-illustration {
        width: 100%;
        height: 320px;
        background: var(--light-beige);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: auto;
        overflow: hidden;
        padding: 1rem;
    }
    .featured-illustration img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* show full image */
        border-radius: 12px;
        background: white;
    }
    
    /* Right Column - Volumes Carousel */
    .featured-volumes-wrapper {
        position: relative;
        width: 100%;
        padding: 0 3.5rem; /* Space for arrows */
        overflow: visible;
    }
    .featured-volumes {
        display: flex;
        gap: 1.25rem;
        align-items: start;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-behavior: smooth;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE and Edge */
        width: 100%;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        justify-content: flex-start;
    }
    .featured-volumes::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    .featured-volume-card {
        flex: 0 0 calc(33.333% - 0.833rem);
        min-width: calc(33.333% - 0.833rem);
        max-width: calc(33.333% - 0.833rem);
    }
    .carousel-nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: var(--gold);
        color: white;
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        z-index: 10;
    }
    .carousel-nav-button.prev {
        left: 0.5rem;
    }
    .carousel-nav-button.next {
        right: 0.5rem;
    }
    .carousel-nav-button:hover:not(:disabled) {
        background: var(--dark-gold);
        transform: translateY(-50%) scale(1.1);
    }
    .carousel-nav-button:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    .carousel-nav-button.prev {
        left: 0;
    }
    .carousel-nav-button.next {
        right: 0;
    }
    .featured-volume-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
        cursor: pointer;
        border: 2px solid transparent;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .featured-volume-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    .featured-volume-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: var(--light-beige);
        padding: 0;
    }
    .featured-volume-image-placeholder {
        width: 100%;
        height: 200px;
        background: var(--light-beige);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-size: 0.9rem;
    }
    .featured-volume-info {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .featured-volume-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0.25rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .featured-volume-category {
        font-size: 0.875rem;
        color: var(--text-light);
        opacity: 0.75;
        margin-bottom: 0.25rem;
    }
    .featured-volume-author {
        font-size: 0.875rem;
        color: var(--text-light);
        opacity: 0.75;
        margin-bottom: 0.75rem;
    }
    .featured-volume-price {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gold);
        opacity: 0.9;
    }
    .featured-volume-info .flex {
        flex-wrap: nowrap;
    }
    .featured-volume-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
        .featured-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        .featured-volume-card {
            flex: 0 0 calc(50% - 0.75rem);
            min-width: calc(50% - 0.75rem);
        }
        .featured-series-title {
            font-size: 2.5rem;
        }
        .featured-volumes-wrapper {
            padding: 0 2.5rem;
        }
        .carousel-nav-button.prev {
            left: 0.5rem;
        }
        .carousel-nav-button.next {
            right: 0.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .featured-section {
            padding: 2rem;
        }
        .featured-volume-card {
            flex: 0 0 calc(50% - 0.75rem);
            min-width: calc(50% - 0.75rem);
        }
        .featured-series-title {
            font-size: 2rem;
        }
        .featured-series-subtitle {
            font-size: 1.1rem;
        }
        .featured-illustration {
            height: 250px;
        }
        .featured-volumes-wrapper {
            padding: 0 2rem;
        }
        .carousel-nav-button {
            width: 40px;
            height: 40px;
        }
        .carousel-nav-button.prev {
            left: 0.5rem;
        }
        .carousel-nav-button.next {
            right: 0.5rem;
        }
    }
    
    @media (max-width: 640px) {
        .featured-volume-card {
            flex: 0 0 calc(100% - 0.5rem);
            min-width: calc(100% - 0.5rem);
        }
    }
    
    /* Regular Product Grid - Full Width */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
        width: 100%;
    }
    .best-sellers-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
    }
    .best-sellers-grid .product-image {
        height: 320px;
    }
</style>

<div class="dashboard-content">
    @if($searchQuery)
        <!-- Main Content Container -->
        <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem;">
            <!-- Search Results -->
            <div class="section-title">
                <span>Search Results for "{{ $searchQuery }}"</span>
            </div>
            @if($searchResults->count() > 0)
                <div class="products-grid">
                @foreach($searchResults as $product)
                    <a href="{{ route('products.show', $product) }}" class="product-card">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-image-placeholder">
                                <span>No Image</span>
                            </div>
                        @endif
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-category">{{ $product->category->name }}</p>
                            @if($product->author)
                                <p class="product-author">By {{ $product->author }}</p>
                            @endif
                            <div class="flex justify-between items-center mt-4" style="gap: 0.5rem;">
                                <span class="text-lg font-bold flex-shrink-0" style="color: var(--gold);">₱{{ number_format($product->price, 2) }}</span>
                                <button type="button" class="add-to-cart-btn" data-product-id="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                            @if($product->stock <= 0)
                                <p class="text-red-500 text-sm mt-2">Out of Stock</p>
                            @elseif($product->stock < 10)
                                <p class="text-orange-500 text-sm mt-2">Only {{ $product->stock }} left!</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
            @else
                <div class="no-products">
                    <p>No products found matching your search.</p>
                </div>
            @endif
        </div>
    @else
        <!-- Main Content Container -->
        <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem;">
            <!-- Featured Section (Two Column: Article + Volumes) -->
            @if($featuredSeriesProducts && $featuredSeriesProducts->count() > 0 && $featuredProduct)
                <div class="featured-section">
                    <div class="featured-heading">Featured Manga</div>
                    <div class="featured-container">
                    <!-- Left Column - Article -->
                    <div class="featured-article">
                        <h1 class="featured-series-title">{{ $featuredSeriesName }}</h1>
                        @if($featuredProduct->description)
                            <p class="featured-series-subtitle">{{ $featuredProduct->description }}</p>
                        @else
                            <p class="featured-series-subtitle">Discover the latest volumes of {{ $featuredSeriesName }} and continue your collection!</p>
                        @endif
                        @if($featuredProduct->image)
                            <div class="featured-illustration">
                                <img src="{{ $featuredProduct->image }}" alt="{{ $featuredSeriesName }}">
                            </div>
                        @else
                            <div class="featured-illustration">
                                <span style="color: var(--text-light); font-size: 1.1rem;">Illustration</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Right Column - Volumes Carousel -->
                    <div class="featured-volumes-wrapper">
                        <button type="button" class="carousel-nav-button prev" data-direction="prev" aria-label="Previous volumes">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <div class="featured-volumes" id="featuredVolumesCarousel">
                            @foreach($featuredSeriesProducts as $product)
                            <a href="{{ route('products.show', $product) }}" class="featured-volume-card">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="featured-volume-image">
                                @else
                                    <div class="featured-volume-image-placeholder">
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <div class="featured-volume-info">
                                    <h3 class="featured-volume-title">{{ $product->name }}</h3>
                                    <p class="featured-volume-category">{{ $product->category->name }}</p>
                                    @if($product->author)
                                        <p class="featured-volume-author">By {{ $product->author }}</p>
                                    @endif
                                    <div class="flex justify-between items-center mt-4" style="gap: 0.5rem;">
                                        <span class="text-lg font-bold flex-shrink-0" style="color: var(--gold);">₱{{ number_format($product->price, 2) }}</span>
                                        <button type="button" class="add-to-cart-btn" data-product-id="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </div>
                                    @if($product->stock <= 0)
                                        <p class="text-red-500 text-sm mt-2">Out of Stock</p>
                                    @elseif($product->stock < 10)
                                        <p class="text-orange-500 text-sm mt-2">Only {{ $product->stock }} left!</p>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <button type="button" class="carousel-nav-button next" data-direction="next" aria-label="Next volumes">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    </div>
                </div>
            @endif

            <!-- Best Sellers -->
            <div class="section-title">
                <span>Best Sellers</span>
                <a href="{{ route('home') }}" class="view-all-link">View all</a>
            </div>
            @if($bestSellers->count() > 0)
                <div class="products-grid best-sellers-grid">
                @foreach($bestSellers as $product)
                    <a href="{{ route('products.show', $product) }}" class="product-card">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-image-placeholder">
                                <span>No Image</span>
                            </div>
                        @endif
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-category">{{ $product->category->name }}</p>
                            @if($product->author)
                                <p class="product-author">By {{ $product->author }}</p>
                            @endif
                            <div class="flex justify-between items-center mt-4" style="gap: 0.5rem;">
                                <span class="text-lg font-bold flex-shrink-0" style="color: var(--gold);">₱{{ number_format($product->price, 2) }}</span>
                                <button type="button" class="add-to-cart-btn" data-product-id="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                            @if($product->stock <= 0)
                                <p class="text-red-500 text-sm mt-2">Out of Stock</p>
                            @elseif($product->stock < 10)
                                <p class="text-orange-500 text-sm mt-2">Only {{ $product->stock }} left!</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
            @else
                <div class="no-products">
                    <p>No new releases this month.</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Add to Cart Functionality
    document.addEventListener('DOMContentLoaded', () => {
        // Add click handlers to all Add to Cart buttons
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = btn.getAttribute('data-product-id');
                
                if (!productId) return;
                
                // Disable button during request
                btn.disabled = true;
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Adding...';
                
                try {
                    const response = await fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ quantity: 1 })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Update cart badge
                        updateCartBadge(data.cart_count);
                        
                        // Show success notification
                        showNotification('Product added to cart!', 'success');
                        
                        // Reset button
                        const originalHTML = btn.innerHTML;
                        btn.innerHTML = '<svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Added!';
                        setTimeout(() => {
                            btn.innerHTML = originalHTML;
                            btn.disabled = false;
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Failed to add to cart', 'error');
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    }
                } catch (error) {
                    console.error('Error adding to cart:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                }
            });
        });
        
        // Function to update cart badge
        function updateCartBadge(count) {
            // Try to find cart badge in dashboard header
            let cartBadge = document.querySelector('.dashboard-header .cart-badge');
            
            // If not found, try in main nav
            if (!cartBadge) {
                cartBadge = document.querySelector('nav .cart-badge');
            }
            
            if (cartBadge) {
                if (count > 0) {
                    cartBadge.textContent = count;
                    cartBadge.style.display = 'flex';
                } else {
                    cartBadge.style.display = 'none';
                }
            }
        }
        
        // Function to show notification
        function showNotification(message, type = 'success') {
            // Remove existing notification if any
            const existing = document.querySelector('.cart-notification');
            if (existing) {
                existing.remove();
            }
            
            const notification = document.createElement('div');
            notification.className = `cart-notification ${type}`;
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 10000;
                font-weight: 600;
                animation: slideIn 0.3s ease;
            `;
            
            // Add animation
            const style = document.createElement('style');
            style.textContent = `
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
            `;
            document.head.appendChild(style);
            
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    });

    // Featured Volumes Carousel Functionality - Make it globally accessible
    window.slideFeaturedVolumes = function(direction) {
        console.log('slideFeaturedVolumes called with direction:', direction);
        const carousel = document.getElementById('featuredVolumesCarousel');
        if (!carousel) {
            console.error('Carousel not found');
            return;
        }

        const firstCard = carousel.querySelector('.featured-volume-card');
        if (!firstCard) {
            console.error('No cards found in carousel');
            return;
        }

        const cardWidth = firstCard.offsetWidth;
        const gap = 20; // 1.25rem = 20px
        const scrollAmount = (cardWidth + gap) * 3; // Scroll 3 cards at a time
        
        console.log('Card width:', cardWidth, 'Scroll amount:', scrollAmount, 'Current scroll:', carousel.scrollLeft);

        if (direction === 'next') {
            const newScroll = carousel.scrollLeft + scrollAmount;
            console.log('Scrolling next to:', newScroll);
            carousel.scrollTo({
                left: newScroll,
                behavior: 'smooth'
            });
        } else if (direction === 'prev') {
            const newScroll = carousel.scrollLeft - scrollAmount;
            console.log('Scrolling prev to:', newScroll);
            carousel.scrollTo({
                left: Math.max(0, newScroll),
                behavior: 'smooth'
            });
        }

        // Update button states after a short delay
        setTimeout(() => {
            window.updateCarouselButtons();
        }, 300);
    };

    window.updateCarouselButtons = function() {
        const carousel = document.getElementById('featuredVolumesCarousel');
        if (!carousel) return;

        const prevButton = carousel.closest('.featured-volumes-wrapper')?.querySelector('.carousel-nav-button.prev');
        const nextButton = carousel.closest('.featured-volumes-wrapper')?.querySelector('.carousel-nav-button.next');

        if (prevButton && nextButton) {
            // Check if we're at the start
            prevButton.disabled = carousel.scrollLeft <= 10;
            
            // Check if we're at the end
            const maxScroll = carousel.scrollWidth - carousel.clientWidth;
            nextButton.disabled = carousel.scrollLeft >= maxScroll - 10; // 10px tolerance
        }
    };

    // Initialize carousel buttons on load
    document.addEventListener('DOMContentLoaded', () => {
        console.log('DOMContentLoaded - Initializing carousel');
        const carousel = document.getElementById('featuredVolumesCarousel');
        console.log('Carousel element:', carousel);
        
        if (carousel) {
            // Add event listeners to navigation buttons
            const wrapper = carousel.closest('.featured-volumes-wrapper');
            console.log('Wrapper element:', wrapper);
            
            const prevButton = wrapper?.querySelector('.carousel-nav-button.prev');
            const nextButton = wrapper?.querySelector('.carousel-nav-button.next');
            
            console.log('Prev button:', prevButton);
            console.log('Next button:', nextButton);
            console.log('slideFeaturedVolumes function:', typeof window.slideFeaturedVolumes);
            
            if (prevButton) {
                prevButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Prev button clicked');
                    if (window.slideFeaturedVolumes) {
                        window.slideFeaturedVolumes('prev');
                    } else {
                        console.error('slideFeaturedVolumes function not found');
                    }
                });
            } else {
                console.error('Prev button not found');
            }
            
            if (nextButton) {
                nextButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Next button clicked');
                    if (window.slideFeaturedVolumes) {
                        window.slideFeaturedVolumes('next');
                    } else {
                        console.error('slideFeaturedVolumes function not found');
                    }
                });
            } else {
                console.error('Next button not found');
            }
            
            window.updateCarouselButtons();
            
            // Update buttons on scroll
            carousel.addEventListener('scroll', () => {
                window.updateCarouselButtons();
            });
            
            // Update on window resize
            window.addEventListener('resize', () => {
                window.updateCarouselButtons();
            });
        } else {
            console.error('Carousel element not found');
        }
    });
</script>
@endpush


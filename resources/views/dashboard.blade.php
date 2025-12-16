@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
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
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }
    .best-sellers-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
    }
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
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
        height: 260px;
        object-fit: cover;
    }
    .best-sellers-grid .product-image {
        height: 320px;
    }
    .product-image-placeholder {
        background: var(--light-beige);
    }
    .product-image-placeholder {
        width: 100%;
        height: 260px;
        background: var(--light-beige);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
    }
    .best-sellers-grid .product-image-placeholder {
        height: 320px;
    }
    .product-info {
        padding: 1.25rem;
    }
    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 0.75rem;
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
        font-size: 1.1rem;
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
        font-size: 2rem;
        font-weight: 900;
        color: var(--text-dark);
        margin: 3rem 0 1rem 0;
        padding: 0 2rem;
    }
    .featured-section {
        margin-top: 0.5rem;
        margin-bottom: 3.5rem;
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2.75rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        margin-left: 2rem;
        margin-right: 2rem;
    }
    .featured-container {
        display: grid;
        grid-template-columns: 32% 68%;
        gap: 2rem;
        align-items: center;
    }
    
    /* Left Column - Article */
    .featured-article {
        display: flex;
        flex-direction: column;
    }
    .featured-series-title {
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--red);
        margin-bottom: 0.35rem;
        line-height: 1.1;
    }
    .featured-series-subtitle {
        font-size: 1.05rem;
        color: var(--red);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .featured-illustration {
        width: 100%;
        height: 460px;
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
        padding: 0 3rem; /* Space for arrows */
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
    }
    .featured-volumes::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    .featured-volume-card {
        flex: 0 0 calc(33.333% - 1rem);
        min-width: calc(33.333% - 1rem);
        max-width: calc(33.333% - 1rem);
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
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .featured-volume-link {
        display: block;
        color: inherit;
        text-decoration: none;
    }
    .featured-volume-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 26px rgba(0, 0, 0, 0.14);
        border-color: var(--gold);
    }
    .featured-volume-image {
        width: 100%;
        height: 320px;
        object-fit: cover; /* fill card like products */
        background: var(--light-beige);
        padding: 0;
    }
    .featured-volume-image-placeholder {
        width: 100%;
        height: 320px;
        background: var(--light-beige);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-size: 0.9rem;
    }
    .featured-volume-info {
        padding: 1.1rem 1.1rem 1.25rem 1.1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .featured-volume-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.6rem;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .featured-volume-price {
        font-size: 1.15rem;
        font-weight: 900;
        color: var(--gold);
        margin-bottom: 0.6rem;
    }
    .quick-view-btn {
        margin-top: auto;
        background-color: var(--gold);
        color: var(--text-dark);
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        text-align: center;
        display: block;
        text-decoration: none;
    }
    .quick-view-btn:hover {
        background-color: var(--dark-gold);
        color: var(--text-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            left: 0;
        }
        .carousel-nav-button.next {
            right: 0;
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
            left: 0;
        }
        .carousel-nav-button.next {
            right: 0;
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
        padding: 0 2rem;
    }
    .best-sellers-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
    }
    .best-sellers-grid .product-image {
        height: 320px;
    }
    /* Hero Section Styles */
    .hero-section {
        background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
        color: white;
        padding: 4rem 0;
        margin-bottom: 3rem;
    }
    .hero-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-align: center;
    }
    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        text-align: center;
    }
    .hero-search-form {
        max-width: 800px;
        margin: 0 auto;
    }
    .hero-search-wrapper {
        position: relative;
        display: flex;
        gap: 0.5rem;
        align-items: center;
        background: white;
        border-radius: 12px;
        padding: 0.5rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    }
    .hero-search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        color: var(--text-dark);
        background: transparent;
    }
    .hero-search-input::placeholder {
        color: var(--text-light);
    }
    .hero-category-select {
        border-left: 2px solid var(--gold-outline);
        padding-left: 1rem;
        padding-right: 1rem;
        border: none;
        outline: none;
        background: transparent;
        font-size: 1rem;
        color: var(--text-dark);
        cursor: pointer;
    }
    .hero-search-button {
        background-color: var(--red);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .hero-search-button:hover {
        background-color: var(--dark-red);
        transform: translateY(-1px);
    }
</style>

<div class="dashboard-content">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="text-center">
                <h1 class="hero-title">Find Your Manga</h1>
                <p class="hero-subtitle">Browse our comprehensive catalog of manga and discover your next favorite series</p>
                
                <!-- Search Bar -->
                <form method="GET" action="{{ route('dashboard') }}" class="hero-search-form">
                    <div class="hero-search-wrapper">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $searchQuery }}" 
                            placeholder="Search manga, titles, authors, or series..." 
                            class="hero-search-input"
                        >
                        <select name="category" class="hero-category-select">
                            <option value="">All categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="hero-search-button">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($searchQuery)
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
                            <div class="product-price">₱{{ number_format($product->price, 2) }}</div>
                            <div class="product-status {{ $product->stock <= 0 ? 'status-sold-out' : 'status-available' }}">
                                <span class="status-dot {{ $product->stock <= 0 ? 'sold-out' : 'available' }}"></span>
                                {{ $product->stock <= 0 ? 'Sold out' : 'On hand' }}
                            </div>
                        </div>
                        <button type="button" class="quick-view-btn" data-product-id="{{ $product->id }}" data-product-url="{{ route('products.show', $product) }}" onclick="event.stopPropagation();">
                            Quick add
                        </button>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>No products found matching your search.</p>
            </div>
        @endif
    @else
        <!-- Featured Section (Two Column: Article + Volumes) -->
        @if($featuredSeriesProducts && $featuredSeriesProducts->count() > 0 && $featuredProduct)
            <div class="featured-heading">Featured Manga</div>
            <div class="featured-section">
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
                            <div class="featured-volume-card">
                                <a href="{{ route('products.show', $product) }}" class="featured-volume-link">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="featured-volume-image">
                                    @else
                                        <div class="featured-volume-image-placeholder">
                                            <span>No Image</span>
                                        </div>
                                    @endif
                                    <div class="featured-volume-info">
                                        <h3 class="featured-volume-title">{{ $product->name }}</h3>
                                        <div class="featured-volume-price">₱{{ number_format($product->price, 2) }}</div>
                                        <div class="featured-volume-status {{ $product->stock <= 0 ? 'status-sold-out' : 'status-available' }}">
                                            <span class="status-dot {{ $product->stock <= 0 ? 'sold-out' : 'available' }}"></span>
                                            {{ $product->stock <= 0 ? 'Sold out' : ($product->stock < 5 ? 'Special Order' : 'On hand') }}
                                        </div>
                                    </div>
                                </a>
                                <button type="button" class="quick-view-btn" data-product-id="{{ $product->id }}" data-product-url="{{ route('products.show', $product) }}" onclick="event.stopPropagation();">
                                    Quick add
                                </button>
                            </div>
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
                            <div class="product-price">₱{{ number_format($product->price, 2) }}</div>
                            <div class="product-status {{ $product->stock <= 0 ? 'status-sold-out' : 'status-available' }}">
                                <span class="status-dot {{ $product->stock <= 0 ? 'sold-out' : 'available' }}"></span>
                                {{ $product->stock <= 0 ? 'Sold out' : 'On hand' }}
                            </div>
                        </div>
                        <button type="button" class="quick-view-btn" data-product-id="{{ $product->id }}" data-product-url="{{ route('products.show', $product) }}" onclick="event.stopPropagation();">
                            Quick add
                        </button>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>No new releases this month.</p>
            </div>
        @endif

        <!-- Newly Added Mangas -->
        <div class="section-title">
            <span>Newly Added Mangas</span>
            <a href="{{ route('home') }}" class="view-all-link">View all</a>
        </div>
        @if($newlyAdded->count() > 0)
            <div class="products-grid">
                @foreach($newlyAdded as $product)
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
                            <div class="product-price">₱{{ number_format($product->price, 2) }}</div>
                            <div class="product-status {{ $product->stock <= 0 ? 'status-sold-out' : 'status-available' }}">
                                <span class="status-dot {{ $product->stock <= 0 ? 'sold-out' : 'available' }}"></span>
                                {{ $product->stock <= 0 ? 'Sold out' : 'On hand' }}
                            </div>
                        <button type="button" class="quick-view-btn" data-product-id="{{ $product->id }}" data-product-url="{{ route('products.show', $product) }}" onclick="event.stopPropagation();">
                            Quick add
                        </button>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>No newly added mangas available.</p>
            </div>
        @endif
    @endif
</div>
</div>
@endsection

@push('scripts')
<script>
    // Quick Add to Cart Functionality
    document.addEventListener('DOMContentLoaded', () => {
        // Add click handlers to all Quick add buttons
        document.querySelectorAll('.quick-view-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = btn.getAttribute('data-product-id');
                
                if (!productId) return;
                
                // Disable button during request
                btn.disabled = true;
                const originalText = btn.textContent;
                btn.textContent = 'Adding...';
                
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
                        btn.textContent = 'Added!';
                        setTimeout(() => {
                            btn.textContent = originalText;
                            btn.disabled = false;
                        }, 1000);
                    } else {
                        showNotification(data.message || 'Failed to add to cart', 'error');
                        btn.textContent = originalText;
                        btn.disabled = false;
                    }
                } catch (error) {
                    console.error('Error adding to cart:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                    btn.textContent = originalText;
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


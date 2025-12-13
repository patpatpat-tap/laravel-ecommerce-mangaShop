@extends('layouts.app')

@section('title', 'Manga Shop - Discover. Collect. Read.')

@section('content')
<style>
    .document-card {
        background-color: var(--light-beige);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid var(--gold-outline);
        text-align: center;
    }
    .document-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-4px);
        border-color: var(--gold);
        background-color: var(--warm-beige);
    }
    .btn-hero {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background-color: var(--gold);
        color: var(--text-dark);
        border: 2px solid var(--gold-outline);
    }
    .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        background-color: var(--dark-gold);
        border-color: var(--gold);
        color: var(--text-dark);
    }
    .btn-hero-secondary {
        background-color: #000000;
        color: var(--red);
        border: 2px solid var(--red);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .btn-hero-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        background-color: #000000;
        border-color: var(--red);
        color: var(--red);
    }
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        text-align: left;
    }
    .hero-subtitle {
        font-size: 1.35rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
        line-height: 1.6;
        text-align: left;
    }
</style>
<!-- Hero / Introduction Section -->
<section class="w-full py-24 md:py-40 relative overflow-hidden" style="background-color: #000000; border-bottom: 2px solid var(--gold-outline); margin-top: 0;">
    <div class="mx-auto relative z-10" style="max-width: 1400px; padding: 5rem 2rem;">
        <div class="max-w-3xl">
            <h1 class="hero-title" style="color: var(--gold);">
                Discover. Collect. Read.
            </h1>
            <p class="hero-subtitle" style="color: var(--gold);">
                Buy legitimate manga online — browse, collect, and order your favorite stories with ease.
            </p>
            <div class="flex flex-row gap-4">
                <a href="{{ route('home') }}" class="btn-hero-secondary">
                    Start Shopping
                </a>
                <a href="{{ route('login') }}" class="btn-hero">
                    Sign In
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works / What You Can Do Section -->
<section class="w-full py-24 md:py-40 border-t-4 border-b-4" style="background-color: white; border-color: var(--gold-outline); margin-top: 0;">
    <div class="mx-auto" style="max-width: 1400px; padding: 5rem 2rem;">
        <div class="text-center mb-24">
            <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--gold);">
                How It Works
            </h2>
        </div>
        
        <div class="mx-auto" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem; max-width: 1200px;">
            <!-- Card 1: Browse Manga -->
            <div class="document-card h-full flex flex-col items-center">
                <div class="flex items-center justify-center mb-6" style="width: 3.5rem; height: 3.5rem; background-color: var(--gold); border-radius: 16px; aspect-ratio: 1;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4" style="color: var(--gold);">Browse Manga</h3>
                <p class="leading-relaxed" style="color: var(--text-light);">
                    Explore genres, volumes, and latest releases
                </p>
            </div>

            <!-- Card 2: Add to Cart -->
            <div class="document-card h-full flex flex-col items-center">
                <div class="flex items-center justify-center mb-6" style="width: 3.5rem; height: 3.5rem; background-color: var(--red); border-radius: 16px; aspect-ratio: 1;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4" style="color: var(--red);">Add to Cart</h3>
                <p class="leading-relaxed" style="color: var(--text-light);">
                    Select your favorite manga
                </p>
            </div>

            <!-- Card 3: Checkout & Order -->
            <div class="document-card h-full flex flex-col items-center">
                <div class="flex items-center justify-center mb-6" style="width: 3.5rem; height: 3.5rem; background-color: var(--gold); border-radius: 16px; aspect-ratio: 1;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4" style="color: var(--gold);">Checkout & Order</h3>
                <p class="leading-relaxed" style="color: var(--text-light);">
                    Place your order and track it easily
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose This Website Section -->
<section class="w-full py-24 md:py-40 my-12 border-t-4 border-b-4" style="background-color: var(--beige); border-color: var(--gold-outline);">
    <div class="mx-auto" style="max-width: 1400px; padding: 5rem 2rem;">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-20" style="color: var(--gold);">
            Why Choose This Website
        </h2>
        
        <div class="mx-auto" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem; max-width: 1200px;">
            <!-- Feature 1: Secure Accounts -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--gold);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--gold);">Secure user accounts</h3>
                <p style="color: var(--text-light);">Your data is protected with industry-standard security</p>
            </div>

            <!-- Feature 2: Easy Order Tracking -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--red);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--red);">Easy order tracking</h3>
                <p style="color: var(--text-light);">Monitor your orders from purchase to delivery</p>
            </div>

            <!-- Feature 3: Smooth Cart Experience -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--gold);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--gold);">Smooth add-to-cart experience</h3>
                <p style="color: var(--text-light);">Intuitive shopping with instant cart updates</p>
            </div>

            <!-- Feature 4: Curated Collection -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--red);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--red);">Curated manga collection</h3>
                <p style="color: var(--text-light);">Carefully selected titles from top publishers</p>
            </div>

            <!-- Feature 5: Fast Checkout -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--gold);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--gold);">Fast & simple checkout</h3>
                <p style="color: var(--text-light);">Complete your purchase in just a few clicks</p>
            </div>

            <!-- Feature 6: Customer Support -->
            <div class="document-card">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto" style="background-color: var(--red);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--red);">Reliable service</h3>
                <p style="color: var(--text-light);">Trusted platform with excellent customer support</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer-section w-full mt-12 border-t-4" style="background-color: #000000; border-color: var(--gold-outline);">
    <div class="footer-container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
            <!-- Website Info -->
            <div>
                <h3 class="text-2xl font-bold mb-4" style="color: var(--gold);">Manga Shop</h3>
                <p style="color: white; opacity: 0.9;">
                    Your trusted source for authentic manga collections. Discover, collect, and read your favorite stories.
                </p>
            </div>

            <!-- Navigation Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: var(--gold);">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('landing') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">Home</a></li>
                    <li><a href="{{ route('home') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">Shop</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">My Orders</a></li>
                        <li><a href="{{ route('cart.index') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">Cart</a></li>
                    @else
                        <li><a href="{{ route('login') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">Login</a></li>
                        <li><a href="{{ route('register') }}" style="color: white; opacity: 0.9;" onmouseover="this.style.opacity='1'; this.style.color='var(--gold)'" onmouseout="this.style.opacity='0.9'; this.style.color='white'" class="transition-all">Register</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: var(--gold);">Get Started</h4>
                <p style="color: white; opacity: 0.9; margin-bottom: 1rem;">
                    Join thousands of manga enthusiasts and start building your collection today.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-block px-6 py-2 rounded-lg font-semibold transition-all hover:scale-105" style="background-color: var(--gold); color: var(--text-dark); border: 2px solid var(--gold-outline);" onmouseover="this.style.backgroundColor='var(--dark-gold)'" onmouseout="this.style.backgroundColor='var(--gold)'">
                        Sign Up Now
                    </a>
                @endguest
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t pt-8 text-center" style="border-color: rgba(255, 255, 255, 0.2);">
            <p style="color: white; opacity: 0.75;">
                &copy; {{ date('Y') }} Manga Shop. All rights reserved.
            </p>
        </div>
    </div>
</footer>
@endsection


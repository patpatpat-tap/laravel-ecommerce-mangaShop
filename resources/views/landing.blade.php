@extends('layouts.app')

@section('title', 'Manga Shop - Discover. Collect. Read.')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
        overflow: hidden;
        margin-top: 0;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 50%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
        animation: pulse 4s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 2rem;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }
    .hero-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: clamp(2.5rem, 8vw, 5.5rem);
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--gold) 0%, #FFD700 50%, var(--gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: fadeInUp 0.8s ease-out;
        letter-spacing: -0.02em;
    }
    .hero-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: clamp(1.125rem, 2.5vw, 1.5rem);
        line-height: 1.6;
        color: rgba(232, 210, 163, 0.95);
        margin-bottom: 2.5rem;
        max-width: 600px;
        animation: fadeInUp 0.8s ease-out 0.2s both;
        font-weight: 400;
    }
    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .btn-hero {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
        background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
        color: var(--text-dark);
        border: 2px solid var(--gold-outline);
        cursor: pointer;
        font-family: 'Poppins', 'Inter', sans-serif;
    }
    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(212, 175, 55, 0.4);
        background: linear-gradient(135deg, var(--dark-gold) 0%, var(--gold) 100%);
    }
    .btn-hero-secondary {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(239, 27, 49, 0.2);
        background: transparent;
        color: var(--red);
        border: 2px solid var(--red);
        cursor: pointer;
        font-family: 'Poppins', 'Inter', sans-serif;
    }
    .btn-hero-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(239, 27, 49, 0.3);
        background: var(--red);
        color: white;
    }

    /* Section Styles */
    .section {
        padding: 6rem 0;
        position: relative;
    }
    .section-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 800;
        text-align: center;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }
    .section-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        text-align: center;
        margin-bottom: 4rem;
        opacity: 0.8;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    /* How It Works Section */
    .how-it-works {
        background: linear-gradient(180deg, #173337 0%, #1a3d42 100%);
        position: relative;
        overflow: hidden;
    }
    .how-it-works::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23E8D2A3' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }
    .how-it-works .section-title {
        color: #E8D2A3;
    }
    .how-it-works .section-subtitle {
        color: rgba(232, 210, 163, 0.8);
    }
    .step-card {
        background: rgba(232, 210, 163, 0.08);
        border: 2px solid rgba(232, 210, 163, 0.2);
        border-radius: 24px;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    .step-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(232, 210, 163, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s;
    }
    .step-card:hover {
        transform: translateY(-8px);
        border-color: rgba(232, 210, 163, 0.4);
        background: rgba(232, 210, 163, 0.12);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    .step-card:hover::before {
        opacity: 1;
    }
    .step-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #E8D2A3 0%, #d4af37 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 8px 20px rgba(232, 210, 163, 0.3);
        transition: all 0.4s;
    }
    .step-card:hover .step-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 30px rgba(232, 210, 163, 0.4);
    }
    .step-icon svg {
        width: 40px;
        height: 40px;
        color: #173337;
    }
    .step-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #E8D2A3;
        margin-bottom: 1rem;
    }
    .step-description {
        font-size: 1rem;
        color: rgba(232, 210, 163, 0.9);
        line-height: 1.6;
    }

    /* Why Choose Section */
    .why-choose {
        background: linear-gradient(180deg, var(--beige) 0%, var(--light-beige) 100%);
        position: relative;
    }
    .why-choose .section-title {
        color: var(--text-dark);
    }
    .why-choose .section-subtitle {
        color: var(--text-light);
    }
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    .feature-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gold) 0%, var(--red) 100%);
        transform: scaleX(0);
        transition: transform 0.4s;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: var(--gold);
    }
    .feature-card:hover::after {
        transform: scaleX(1);
    }
    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.4s;
    }
    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(-5deg);
    }
    .feature-icon.gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
    }
    .feature-icon.red {
        background: linear-gradient(135deg, var(--red) 0%, var(--dark-red) 100%);
    }
    .feature-icon svg {
        width: 35px;
        height: 35px;
        color: white;
    }
    .feature-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-dark);
    }
    .feature-description {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    /* Footer */
    .footer-section {
        background: linear-gradient(180deg, #000000 0%, #0a0a0a 100%);
        padding: 4rem 0 2rem;
        position: relative;
    }
    .footer-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--gold) 50%, transparent 100%);
    }
    .footer-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 1rem;
    }
    .footer-text {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
    }
    .footer-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    .footer-link:hover {
        color: var(--gold);
        transform: translateX(4px);
    }
    .footer-heading {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gold);
        margin-bottom: 1rem;
    }


    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            height: 100vh;
            min-height: 100vh;
        }
        .section {
            padding: 4rem 0;
        }
        .step-card, .feature-card {
            padding: 2rem;
        }
    }

    /* Grid Layouts */
    .steps-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div style="max-width: 800px;">
            <h1 class="hero-title">
                Discover. Collect. Read.
            </h1>
            <p class="hero-subtitle">
                Your premier destination for authentic manga collections. Browse thousands of volumes, build your library, and dive into captivating stories from your favorite series.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('home') }}" class="btn-hero-secondary">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Start Shopping
                </a>
                @guest
                    <button onclick="openModal('loginModal')" class="btn-hero" style="border: none;">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    Sign In
                    </button>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section how-it-works">
    <div style="position: relative; z-index: 1;">
        <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Get started in three simple steps</p>
            
            <div class="steps-grid">
                <!-- Step 1: Browse -->
                <div class="step-card">
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                    <h3 class="step-title">Browse Collection</h3>
                    <p class="step-description">
                        Explore our extensive catalog of manga volumes. Filter by genre, author, or series to find exactly what you're looking for.
                </p>
            </div>

                <!-- Step 2: Add to Cart -->
                <div class="step-card">
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                    <h3 class="step-title">Add to Cart</h3>
                    <p class="step-description">
                        Select your favorite volumes and add them to your cart. Review your selections and adjust quantities as needed.
                </p>
            </div>

                <!-- Step 3: Checkout -->
                <div class="step-card">
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    </div>
                    <h3 class="step-title">Checkout & Enjoy</h3>
                    <p class="step-description">
                        Complete your purchase with secure checkout. Track your order and receive your manga collection delivered to your door.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="section why-choose">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        <h2 class="section-title">Why Choose Manga Shop</h2>
        <p class="section-subtitle">Experience the best in manga shopping with features designed for collectors and readers</p>
        
        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon gold">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Secure Accounts</h3>
                <p class="feature-description">Your personal information and payment details are protected with industry-standard encryption and security measures.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy Order Tracking</h3>
                <p class="feature-description">Monitor your orders from purchase to delivery with real-time updates and detailed tracking information.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon gold">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Smooth Shopping</h3>
                <p class="feature-description">Intuitive interface with instant cart updates and seamless browsing experience across all devices.</p>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card">
                <div class="feature-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Curated Collection</h3>
                <p class="feature-description">Carefully selected titles from top publishers, featuring the latest releases and timeless classics.</p>
            </div>

            <!-- Feature 5 -->
            <div class="feature-card">
                <div class="feature-icon gold">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Fast Checkout</h3>
                <p class="feature-description">Complete your purchase in just a few clicks with our streamlined checkout process.</p>
            </div>

            <!-- Feature 6 -->
            <div class="feature-card">
                <div class="feature-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Reliable Service</h3>
                <p class="feature-description">Trusted platform with excellent customer support and commitment to quality service.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer-section">
    <div class="footer-container" style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; margin-bottom: 3rem;">
            <!-- Website Info -->
            <div>
                <h3 class="footer-title">Manga Shop</h3>
                <p class="footer-text">
                    Your trusted source for authentic manga collections. Discover, collect, and read your favorite stories with ease.
                </p>
            </div>

            <!-- Navigation Links -->
            <div>
                <h4 class="footer-heading">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                    <li><a href="{{ route('landing') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('home') }}" class="footer-link">Shop</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="footer-link">My Orders</a></li>
                        <li><a href="{{ route('cart.index') }}" class="footer-link">Cart</a></li>
                    @else
                        <li><a onclick="openModal('loginModal')" class="footer-link" style="cursor: pointer;">Login</a></li>
                        <li><a onclick="openModal('registerModal')" class="footer-link" style="cursor: pointer;">Register</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Get Started -->
            <div>
                <h4 class="footer-heading">Get Started</h4>
                <p class="footer-text" style="margin-bottom: 1.5rem;">
                    Join thousands of manga enthusiasts and start building your collection today.
                </p>
                @guest
                    <button onclick="openModal('registerModal')" class="btn-hero" style="border: none; cursor: pointer;">
                        Sign Up Now
                    </button>
                @endguest
            </div>
        </div>

        <!-- Copyright -->
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 2rem; text-align: center;">
            <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem;">
                &copy; {{ date('Y') }} Manga Shop. All rights reserved.
            </p>
        </div>
    </div>
</footer>
@endsection

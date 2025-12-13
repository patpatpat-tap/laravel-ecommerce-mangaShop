<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Manga Shop')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :host, :root {
            --fa-style-family-classic: "Font Awesome 6 Free";
            --fa-font-solid: normal 900 1em / 1 "Font Awesome 6 Free";
            --fa-font-regular: normal 400 1em / 1 "Font Awesome 6 Free";
            --fa-style-family-brands: "Font Awesome 6 Brands";
            --fa-font-brands: normal 400 1em / 1 "Font Awesome 6 Brands";
            
            /* Elegant Gold, Red & Beige Palette */
            --beige: #F5F5DC;
            --light-beige: #FAF9F6;
            --warm-beige: #E8E4D9;
            --gold: #D4AF37;
            --gold-outline: #D4AF37;
            --dark-gold: #B8860B;
            --red: #EF1B31;
            --dark-red: #C41E3A;
            --text-dark: #2C2C2C;
            --text-light: #4A4A4A;
        }
        body {
            font-family: 'Poppins', 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--beige);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            position: relative;
        }
        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .footer-section {
            padding: 4rem 0 2rem;
        }
    </style>
</head>
<body>
    <nav style="background-color: var(--light-beige); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-bottom: 2px solid var(--gold-outline); position: fixed; top: 0; left: 0; right: 0; z-index: 1000; width: 100%;">
        <div class="nav-container" style="height: 6rem;">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('landing') }}" class="text-2xl font-bold flex items-center gap-3" style="color: var(--gold);">
                            <div class="flex items-center justify-center" style="width: 3.5rem; height: 3.5rem; background-color: var(--gold); border-radius: 16px; aspect-ratio: 1;">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            Manga Shop
                        </a>
                    </div>
                </div>
                <div class="flex items-center" style="gap: 1rem;">
                    @auth
                        <a href="{{ route('cart.index') }}" class="relative transition-all" style="color: var(--text-dark);" onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--text-dark)'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                <span class="absolute -top-2 -right-2 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold" style="background-color: var(--red);">
                                    {{ auth()->user()->cart->items->sum('quantity') }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('orders.index') }}" class="transition-all" style="color: var(--text-dark);" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--text-dark)'">Orders</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="transition-all" style="color: var(--text-dark);" onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--text-dark)'">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="transition-all" style="color: var(--text-dark); background: none; border: none; cursor: pointer;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--text-dark)'">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md font-semibold transition-all" style="padding: 0.75rem 1.5rem; font-size: 0.95rem; font-weight: 600; background-color: var(--gold); color: var(--text-dark); border: 2px solid var(--gold-outline); border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);" onmouseover="this.style.backgroundColor='var(--dark-gold)'; this.style.color='var(--text-dark)'" onmouseout="this.style.backgroundColor='var(--gold)'; this.style.color='var(--text-dark)'">Sign In</a>
                        <a href="{{ route('register') }}" class="rounded-md font-semibold transition-all" style="padding: 0.75rem 1.5rem; font-size: 0.95rem; font-weight: 600; background-color: #000000; color: var(--red); border: 2px solid var(--red); border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.1)'">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="px-4 py-3 rounded relative max-w-7xl mx-auto mt-4" role="alert" style="background-color: rgba(212, 175, 55, 0.1); border: 2px solid var(--gold); color: var(--gold);">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="px-4 py-3 rounded relative max-w-7xl mx-auto mt-4" role="alert" style="background-color: rgba(239, 27, 49, 0.1); border: 2px solid var(--red); color: var(--red);">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <main style="padding-top: 6rem;">
        @yield('content')
    </main>
</body>
</html>


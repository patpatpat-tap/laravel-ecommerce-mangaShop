<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Modal Styles */
        /* Modern Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 249, 246, 0.98) 100%);
            margin: auto;
            padding: 0;
            border: none;
            border-radius: 24px;
            width: 90%;
            max-width: 480px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(212, 175, 55, 0.1);
            animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
            position: relative;
        }
        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--dark-gold) 50%, var(--gold) 100%);
        }
        @keyframes modalSlideIn {
            from {
                transform: translateY(-30px) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }
        .modal-header {
            padding: 2.5rem 2.5rem 1.5rem;
            text-align: center;
            position: relative;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 100%);
        }
        .modal-title {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
            letter-spacing: -0.02em;
        }
        .close-modal {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            border: none;
            color: var(--text-dark);
            font-size: 1.5rem;
            font-weight: 300;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            line-height: 1;
        }
        .close-modal:hover {
            background: rgba(239, 27, 49, 0.1);
            color: var(--red);
            transform: rotate(90deg);
        }
        .modal-body {
            padding: 0 2.5rem 2.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .form-label {
            display: block;
            font-family: 'Poppins', 'Inter', sans-serif;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
            font-size: 0.95rem;
            letter-spacing: 0.01em;
        }
        .form-input-wrapper {
            position: relative;
        }
        .form-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: var(--text-light);
            pointer-events: none;
            transition: color 0.2s;
        }
        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Poppins', 'Inter', sans-serif;
            background-color: white;
            color: var(--text-dark);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 
                0 0 0 4px rgba(212, 175, 55, 0.1),
                0 4px 12px rgba(212, 175, 55, 0.15);
            transform: translateY(-1px);
        }
        .form-input:focus + .form-input-icon,
        .form-input:not(:placeholder-shown) + .form-input-icon {
            color: var(--gold);
        }
        .form-input.error {
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(239, 27, 49, 0.1);
        }
        .form-input.error:focus {
            box-shadow: 
                0 0 0 4px rgba(239, 27, 49, 0.1),
                0 4px 12px rgba(239, 27, 49, 0.15);
        }
        .error-message {
            color: var(--red);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .form-checkbox input {
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
            accent-color: var(--gold);
        }
        .form-checkbox label {
            font-size: 0.9rem;
            color: var(--text-light);
            cursor: pointer;
        }
        .btn-modal {
            width: 100%;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            font-family: 'Poppins', 'Inter', sans-serif;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-modal::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn-modal:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn-modal-primary {
            background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
            color: var(--text-dark);
            box-shadow: 0 4px 16px rgba(212, 175, 55, 0.3);
        }
        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.4);
        }
        .btn-modal-primary:active {
            transform: translateY(0);
        }
        .btn-modal-secondary {
            background-color: #000000;
            color: var(--red);
            border: 2px solid var(--red);
        }
        .btn-modal-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .modal-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
            color: var(--text-light);
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }
        .modal-footer a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .modal-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: width 0.3s;
        }
        .modal-footer a:hover {
            color: var(--dark-gold);
        }
        .modal-footer a:hover::after {
            width: 100%;
        }
        .modal-link {
            cursor: pointer;
        }
        /* Dashboard Header Styles */
        .dashboard-header {
            background-color: var(--light-beige);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid var(--gold-outline);
            padding: 1.5rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            width: 100%;
        }
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-dark);
            text-decoration: none;
        }
        .logo-icon {
            width: 3.5rem;
            height: 3.5rem;
            background-color: var(--gold);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .logo-icon:hover {
            background-color: var(--dark-gold);
        }
        .logo-text {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .search-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
        }
        .dashboard-header .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .search-bar-wrapper {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: white;
            border-radius: 12px;
            padding: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: var(--text-dark);
        }
        .category-dropdown {
            border-left: 2px solid var(--gold-outline);
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .category-select {
            border: none;
            outline: none;
            background: transparent;
            font-size: 0.95rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem 0;
        }
        .search-button {
            background-color: var(--red);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }
        .search-button:hover {
            background-color: var(--dark-red);
            transform: translateY(-1px);
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .cart-icon-wrapper {
            position: relative;
            cursor: pointer;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: transparent;
            border-radius: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .cart-icon-wrapper:hover {
            color: var(--gold);
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--red);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }
        .user-pill {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: transparent;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s;
        }
        .user-pill:hover {
            color: var(--gold);
        }
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            z-index: 1000;
            display: none;
            overflow: hidden;
        }
        .user-dropdown.show {
            display: block !important;
        }
        .user-dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.95rem;
        }
        .user-dropdown-item:last-child {
            border-bottom: none;
        }
        .user-dropdown-item:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--red);
        }
        .user-dropdown-item.logout {
            color: var(--red);
        }
        .user-dropdown-item.logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Hero Button Styles for Nav Bar */
        .btn-hero {
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            background-color: var(--gold) !important;
            color: var(--text-dark) !important;
            border: 2px solid var(--gold-outline) !important;
            cursor: pointer !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            background-color: var(--dark-gold);
            border-color: var(--gold);
            color: var(--text-dark);
        }
        .btn-hero-secondary {
            background-color: #000000 !important;
            color: var(--red) !important;
            border: 2px solid var(--red) !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
            cursor: pointer !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        .btn-hero-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            background-color: #000000;
            border-color: var(--red);
            color: var(--red);
        }
    </style>
</head>
<body>
    @if(request()->routeIs('landing'))
        <!-- Landing Page Nav Bar with Sign In/Sign Up -->
        <nav class="dashboard-header" style="background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%) !important; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 2rem 0;">
            <div class="search-container">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 2rem; width: 100%;">
                    <!-- Logo on the left -->
                    <a href="{{ route('dashboard') }}" class="logo-section" style="color: white !important; text-decoration: none !important; display: flex !important; align-items: center !important; gap: 1rem !important; cursor: pointer;">
                        <div class="logo-icon" style="width: 3.5rem !important; height: 3.5rem !important; background-color: rgba(255, 255, 255, 0.2) !important; border-radius: 16px !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s; flex-shrink: 0;">
                            <svg style="width: 2rem !important; height: 2rem !important; color: white !important; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="logo-text" style="color: white !important; font-size: 1.75rem !important; font-weight: 800 !important; white-space: nowrap;">Manga Shop</span>
                    </a>

                    <!-- Right Side: Sign In and Sign Up -->
                    <div class="header-right" style="display: flex; align-items: center; gap: 1rem;">
                        @guest
                            <button type="button" onclick="openModal('loginModal')" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none; border: none; font-weight: 600; font-size: 0.95rem;">
                                Sign In
                            </button>
                            <button type="button" onclick="openModal('registerModal')" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none; border: none; font-weight: 600; font-size: 0.95rem;">
                                Sign Up
                            </button>
                        @else
                            <a href="{{ route('dashboard') }}" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                                Go to Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    @elseif(request()->routeIs('products.show') || request()->routeIs('cart.index') || request()->routeIs('checkout') || request()->routeIs('orders.index') || request()->routeIs('orders.show') || request()->routeIs('home') || request()->routeIs('dashboard'))
        @php
            $dropdownId = 'userDropdown';
            if (request()->routeIs('home')) {
                $dropdownId = 'userDropdownShop';
            } elseif (request()->routeIs('dashboard')) {
                $dropdownId = 'userDropdownDashboard';
            } elseif (request()->routeIs('cart.index')) {
                $dropdownId = 'userDropdownCart';
            } elseif (request()->routeIs('checkout')) {
                $dropdownId = 'userDropdownCheckout';
            } elseif (request()->routeIs('orders.index') || request()->routeIs('orders.show')) {
                $dropdownId = 'userDropdownOrders';
            } elseif (request()->routeIs('products.show')) {
                $dropdownId = 'userDropdownProduct';
            }
        @endphp
        <nav class="dashboard-header" style="background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%) !important; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 2rem 0;">
            <div class="search-container">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 2rem; width: 100%;">
                    <!-- Logo on the left -->
                    <a href="{{ route('dashboard') }}" class="logo-section" style="color: white !important; text-decoration: none !important; display: flex !important; align-items: center !important; gap: 1rem !important; cursor: pointer;">
                        <div class="logo-icon" style="width: 3.5rem !important; height: 3.5rem !important; background-color: rgba(255, 255, 255, 0.2) !important; border-radius: 16px !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s; flex-shrink: 0;">
                            <svg style="width: 2rem !important; height: 2rem !important; color: white !important; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="logo-text" style="color: white !important; font-size: 1.75rem !important; font-weight: 800 !important; white-space: nowrap;">Manga Shop</span>
                    </a>

                    <!-- Right Side: Shop, Cart, Orders, and User -->
                    <div class="header-right" style="display: flex; align-items: center; gap: 1.5rem;">
                        <!-- Shop Button -->
                        <a href="{{ route('home') }}" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Shop</span>
                        </a>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Cart</span>
                            @auth
                                <span class="cart-badge" style="{{ auth()->user()->cart && auth()->user()->cart->items->count() > 0 ? '' : 'display: none;' }}">
                                    {{ auth()->user()->cart ? auth()->user()->cart->items->sum('quantity') : 0 }}
                                </span>
                            @endauth
                        </a>

                        <!-- Orders Button -->
                        @auth
                            <a href="{{ route('orders.index') }}" class="cart-icon-wrapper" style="position: relative; cursor: pointer; color: white !important; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(255, 255, 255, 0.2); border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                                <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                </svg>
                                <span>Orders</span>
                            </a>
                        @endauth

                        <!-- User Pill -->
                        @auth
                            <div class="user-pill" onclick="toggleUserDropdown(event)" style="position: relative; display: flex; align-items: center; gap: 0.75rem; background: rgba(255, 255, 255, 0.2); padding: 0.5rem 1rem; border-radius: 25px; color: white !important; cursor: pointer; transition: all 0.2s;">
                                <div class="user-avatar" style="width: 32px; height: 32px; border-radius: 50%; background: white; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 22px; height: 22px; color: var(--gold);" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-6 2.24-6 5v1h12v-1c0-2.76-2.67-5-6-5z"/>
                                    </svg>
                                </div>
                                <div style="font-weight: 600; color: white !important;">
                                    {{ auth()->user()->name }}
                                </div>
                                <svg style="width: 16px; height: 16px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                                <div class="user-dropdown" id="{{ $dropdownId }}" style="position: absolute; top: 100%; right: 0; margin-top: 0.5rem; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); min-width: 180px; z-index: 10000 !important; display: none; overflow: visible;">
                                    <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;" onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit" class="user-dropdown-item logout" style="display: block !important; padding: 0.75rem 1rem !important; color: var(--red) !important; text-decoration: none !important; transition: all 0.2s !important; border: none !important; background: none !important; cursor: pointer !important; font-size: 0.95rem !important; width: 100% !important; text-align: left !important; pointer-events: auto !important;">
                                            <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>Logout
                                        </button>
                                    </form>
                                </div>
                                <style>
                                    #{{ $dropdownId }}.show {
                                        display: block !important;
                                    }
                                </style>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

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

    <main style="padding-top: {{ request()->routeIs('dashboard') || request()->routeIs('cart.index') || request()->routeIs('orders.index') || request()->routeIs('checkout') || request()->routeIs('products.show') ? '8rem' : (request()->routeIs('landing') ? '0' : '6rem') }};">
        @yield('content')
    </main>

    <!-- Login Modal -->
    <div id="loginModal" class="modal" onclick="if(event.target === this) closeModal('loginModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Sign In</h2>
                <button class="close-modal" onclick="closeModal('loginModal')" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="login_email" class="form-label">Email</label>
                        <div class="form-input-wrapper">
                            <input type="email" name="email" id="login_email" class="form-input" autocomplete="email" placeholder="Enter your email" required>
                            <svg class="form-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div id="login_email_error" class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="form-label">Password</label>
                        <div class="form-input-wrapper">
                            <input type="password" name="password" id="login_password" class="form-input" autocomplete="current-password" placeholder="Enter your password" required>
                            <svg class="form-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div id="login_password_error" class="error-message"></div>
                    </div>
                    <button type="submit" class="btn-modal btn-modal-primary">
                        <span style="position: relative; z-index: 1;">Sign In</span>
                    </button>
                </form>
                <div class="modal-footer">
                    Don't have an account? <a onclick="closeModal('loginModal'); openModal('registerModal');" class="modal-link">Sign up here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal" onclick="if(event.target === this) closeModal('registerModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Sign Up</h2>
                <button class="close-modal" onclick="closeModal('registerModal')" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="register_name" class="form-label">Full Name</label>
                        <div class="form-input-wrapper">
                            <input type="text" name="name" id="register_name" class="form-input" autocomplete="name" placeholder="Enter your full name" required>
                            <svg class="form-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div id="register_name_error" class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="register_email" class="form-label">Email</label>
                        <div class="form-input-wrapper">
                            <input type="email" name="email" id="register_email" class="form-input" autocomplete="email" placeholder="Enter your email" required>
                            <svg class="form-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div id="register_email_error" class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="register_password" class="form-label">Password</label>
                        <div class="form-input-wrapper">
                            <input type="password" name="password" id="register_password" class="form-input" autocomplete="new-password" placeholder="Create a password" required>
                            <svg class="form-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div id="register_password_error" class="error-message"></div>
                    </div>
                    <button type="submit" class="btn-modal btn-modal-primary">
                        <span style="position: relative; z-index: 1;">Sign Up</span>
                    </button>
                </form>
                <div class="modal-footer">
                    Already have an account? <a onclick="closeModal('registerModal'); openModal('loginModal');" class="modal-link">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                clearErrors(modalId);
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = '';
                const form = modal.querySelector('form');
                if (form) form.reset();
                clearErrors(modalId);
            }
        }

        function clearErrors(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            modal.querySelectorAll('.form-input.error').forEach(el => el.classList.remove('error'));
        }

        function showErrors(modalId, errors) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            Object.keys(errors || {}).forEach(field => {
                const input = modal.querySelector(`[name="${field}"]`);
                if (input) input.classList.add('error');
                const errDiv = modal.querySelector(`#${modalId === 'loginModal' ? 'login' : 'register'}_${field}_error`);
                if (errDiv) errDiv.textContent = errors[field]?.[0] || '';
            });
        }

        async function submitForm(form, modalId) {
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton?.textContent;
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
            }
            clearErrors(modalId);

            const formData = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': csrfToken, 
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: formData
                });
                
                // Handle redirects (302, 301, etc.) - means login was successful
                // When redirect is not manual, fetch follows redirects automatically
                // So if we get here with status 200, check if it's JSON or HTML
                if (response.status >= 300 && response.status < 400) {
                    // Redirect received - get Location header
                    const redirectUrl = response.headers.get('Location') || '/dashboard';
                    closeModal(modalId);
                    window.location.href = redirectUrl.startsWith('http') ? redirectUrl : window.location.origin + redirectUrl;
                    return;
                }
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type') || '';
                if (!contentType.includes('application/json')) {
                    // If we get HTML instead of JSON, try to parse it
                    // This might happen if the server doesn't detect JSON request properly
                    const text = await response.text();
                    
                    // If response contains dashboard content, login was successful
                    if (text.includes('dashboard') || text.includes('Dashboard') || 
                        text.includes('Manga Shop') || response.status === 200) {
                        closeModal(modalId);
                        // Try to extract redirect URL from response if possible
                        const dashboardMatch = text.match(/href=["']([^"']*\/dashboard[^"']*)["']/);
                        const redirectUrl = dashboardMatch ? dashboardMatch[1] : '/dashboard';
                        window.location.href = redirectUrl;
                        return;
                    }
                    
                    // If it's a validation error page or contains error messages
                    if (text.includes('credentials') || text.includes('error') || response.status === 422) {
                        showErrors(modalId, { email: ['The provided credentials do not match our records.'] });
                        return;
                    }
                    
                    // Unknown response - log it and show error
                    console.error('Unexpected response type:', contentType, 'Status:', response.status);
                    showErrors(modalId, { email: ['An error occurred. Please try again.'] });
                    return;
                }
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    closeModal(modalId);
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.reload();
                    }
                } else if (response.status === 422) {
                    // Validation errors
                    if (data.errors) {
                        showErrors(modalId, data.errors);
                    } else if (data.message) {
                        showErrors(modalId, { email: [data.message] });
                    } else {
                        showErrors(modalId, { email: ['Please check your input and try again.'] });
                    }
                } else if (data.message) {
                    showErrors(modalId, { email: [data.message] });
                } else {
                    showErrors(modalId, { email: ['An error occurred. Please try again.'] });
                }
            } catch (e) {
                console.error('Login error:', e);
                // If error message contains HTML (dashboard page), login was successful
                if (e.message && (e.message.includes('dashboard') || e.message.includes('Dashboard') || e.message.includes('<!DOCTYPE html>'))) {
                    closeModal(modalId);
                    window.location.href = '/dashboard';
                    return;
                }
                // Check if it's a validation error
                if (e.name === 'ValidationException' || e.message.includes('credentials')) {
                    showErrors(modalId, { email: ['The provided credentials do not match our records.'] });
                } else {
                    showErrors(modalId, { email: ['An error occurred. Please try again.'] });
                }
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            if (loginForm) {
                loginForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    submitForm(loginForm, 'loginModal');
                });
            }
            if (registerForm) {
                registerForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    submitForm(registerForm, 'registerModal');
                });
            }

            // Close on Escape
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    ['loginModal','registerModal'].forEach(closeModal);
                }
            });
        });
    </script>
    
    <script>
        // User Dropdown Toggle
        function toggleUserDropdown(event) {
            event.stopPropagation();
            const userPill = event.target.closest('.user-pill');
            if (!userPill) {
                console.error('User pill not found');
                return;
            }
            
            const dropdown = userPill.querySelector('.user-dropdown');
            if (!dropdown) {
                console.error('Dropdown not found in user pill');
                return;
            }
            
            const isOpen = dropdown.classList.contains('show') || dropdown.style.display === 'block';
            
            // Close all dropdowns first
            document.querySelectorAll('.user-dropdown').forEach(d => {
                d.classList.remove('show');
                d.style.display = 'none';
            });
            
            // Toggle this dropdown
            if (!isOpen) {
                dropdown.classList.add('show');
                dropdown.style.display = 'block';
            } else {
                dropdown.classList.remove('show');
                dropdown.style.display = 'none';
            }
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            // Don't close if clicking inside the dropdown or the user pill
            if (!event.target.closest('.user-pill') && !event.target.closest('.user-dropdown')) {
                document.querySelectorAll('.user-dropdown').forEach(d => {
                    d.classList.remove('show');
                    d.style.display = 'none';
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Manga Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :host, :root {
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
        }
        .admin-sidebar {
            background: linear-gradient(180deg, #000000 0%, #1a1a1a 100%);
            border-right: 2px solid var(--gold-outline);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 999;
            display: flex;
            flex-direction: column;
            width: 16rem;
        }
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(212, 175, 55, 0.3);
            border-radius: 3px;
        }
        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(212, 175, 55, 0.5);
        }
        .admin-sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            flex-shrink: 0;
            margin-bottom: 0.5rem;
        }
        .admin-panel-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            background: rgba(212, 175, 55, 0.1);
            border: 2px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s;
        }
        .admin-panel-brand:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--gold);
        }
        .admin-panel-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        .admin-panel-icon svg {
            width: 22px;
            height: 22px;
            color: white;
        }
        .admin-panel-text {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: -0.01em;
        }
        .admin-sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }
        .admin-sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            flex-shrink: 0;
        }
        .admin-sidebar-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            margin: 0.5rem 1rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: rgba(255, 255, 255, 0.05);
            font-weight: 500;
            font-size: 0.95rem;
        }
        .admin-sidebar-button:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: rgba(212, 175, 55, 0.3);
            color: white;
            transform: translateX(4px);
        }
        .admin-sidebar-button.active {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.15) 100%);
            border-color: var(--gold);
            color: var(--gold);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
        }
        .admin-sidebar-button svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }
        .admin-sidebar-button.active svg {
            color: var(--gold);
        }
        .admin-sidebar-button:not(.active) svg {
            color: rgba(255, 255, 255, 0.7);
        }
        .admin-back-to-shop {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            margin: 0.5rem 1rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(212, 175, 55, 0.3);
            background: rgba(212, 175, 55, 0.1);
            font-weight: 500;
            font-size: 0.95rem;
        }
        .admin-back-to-shop:hover {
            background: rgba(212, 175, 55, 0.2);
            border-color: var(--gold);
            color: var(--gold);
            transform: translateX(4px);
        }
        .admin-back-to-shop svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.7);
        }
        .admin-back-to-shop:hover svg {
            color: var(--gold);
        }
        .admin-navbar {
            background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .admin-navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }
        .admin-logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
            text-decoration: none;
            margin-left: -0.5rem;
        }
        .admin-logo-icon {
            width: 3.5rem;
            height: 3.5rem;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .admin-logo-icon:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .admin-logo-icon svg {
            width: 2rem;
            height: 2rem;
            color: white;
        }
        .admin-logo-text {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            white-space: nowrap;
        }
        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .admin-user-pill:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .admin-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .admin-user-avatar svg {
            width: 22px;
            height: 22px;
            color: var(--gold);
        }
        .admin-user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            z-index: 10000;
            display: none;
            overflow: visible;
        }
        .admin-user-dropdown.show {
            display: block !important;
        }
        .admin-user-dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.95rem;
            width: 100%;
            text-align: left;
        }
        .admin-user-dropdown-item:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        .admin-user-dropdown-item.logout {
            color: var(--red);
        }
        .admin-user-dropdown-item.logout:hover {
            background: rgba(239, 27, 49, 0.1);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 admin-sidebar text-white">
            <div class="admin-sidebar-header">
                <div class="admin-panel-brand">
                    <div class="admin-panel-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="admin-panel-text">Admin Panel</div>
                </div>
            </div>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-button {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-sidebar-button {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>Products</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="admin-sidebar-button {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="admin-sidebar-button {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                    </svg>
                    <span>Orders</span>
                </a>
                <a href="{{ route('admin.users') }}" class="admin-sidebar-button {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Users</span>
                </a>
            </nav>
            <div class="admin-sidebar-footer">
                <a href="{{ route('dashboard') }}" class="admin-back-to-shop">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to Shop</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col" style="margin-left: 16rem;">
            <!-- Admin Nav Bar -->
            <nav class="admin-navbar">
                <div class="admin-navbar-content">
                    <!-- Logo -->
                    <a href="{{ route('admin.dashboard') }}" class="admin-logo-section">
                        <div class="admin-logo-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="admin-logo-text">Manga Shop</span>
                    </a>

                    <!-- User Pill -->
                    <div class="admin-user-pill" onclick="toggleAdminUserDropdown(event)">
                        <div class="admin-user-avatar">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-6 2.24-6 5v1h12v-1c0-2.76-2.67-5-6-5z"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600; color: white;">
                            {{ auth()->user()->name }}
                        </div>
                        <svg style="width: 16px; height: 16px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <div class="admin-user-dropdown" id="adminUserDropdown">
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;" onclick="event.stopPropagation();">
                            @csrf
                                <button type="submit" class="admin-user-dropdown-item logout">
                                    <svg style="width: 16px; height: 16px; margin-right: 0.5rem; display: inline-block; vertical-align: middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                        </form>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-1 p-6" style="background-color: var(--beige);">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg border-2" style="background-color: rgba(212, 175, 55, 0.1); border-color: var(--gold); color: var(--gold);" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 px-4 py-3 rounded-lg border-2" style="background-color: rgba(239, 27, 49, 0.1); border-color: var(--red); color: var(--red);" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleAdminUserDropdown(event) {
            event.stopPropagation();
            const userPill = event.currentTarget;
            const dropdown = userPill.querySelector('.admin-user-dropdown');
            
            // Close all dropdowns
            document.querySelectorAll('.admin-user-dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                    d.style.display = 'none';
                }
            });
            
            // Toggle current dropdown
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                dropdown.style.display = 'none';
            } else {
                dropdown.classList.add('show');
                dropdown.style.display = 'block';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.admin-user-pill')) {
                document.querySelectorAll('.admin-user-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                    dropdown.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>


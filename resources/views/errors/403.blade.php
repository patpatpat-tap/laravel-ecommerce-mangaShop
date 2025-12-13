<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Denied - Manga Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="mx-auto h-24 w-24 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Access Denied</h2>
            <p class="text-gray-600 mb-8">You don't have permission to access this page.</p>
            <div class="space-x-4">
                <a href="{{ route('home') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Go Home
                </a>
                @auth
                    <a href="{{ url()->previous() }}" class="inline-block px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Go Back
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>


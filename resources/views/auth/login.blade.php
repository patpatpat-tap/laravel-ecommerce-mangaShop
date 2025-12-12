<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MangaVerse | Join the Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0" rel="stylesheet">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-black via-indigo-900 to-gray-900 text-white min-h-screen flex items-center justify-center p-4">

    <div class="bg-gray-800/70 backdrop-blur-lg p-8 rounded-2xl shadow-2xl w-full max-w-md border border-indigo-600/30">
        <!-- Navigation Tabs -->
        <div class="flex mb-6 bg-gray-900/50 rounded-lg p-1">
            <button id="login-btn" class="flex-1 py-2 px-4 rounded-md font-semibold transition-all duration-200 bg-indigo-600 text-white shadow">
                Login
            </button>
            <button id="register-btn" class="flex-1 py-2 px-4 rounded-md font-semibold transition-all duration-200 text-gray-400 hover:text-white">
                Register
            </button>
            <button id="admin-btn" class="flex-1 py-2 px-4 rounded-md font-semibold transition-all duration-200 text-gray-400 hover:text-white">
                Admin
            </button>
        </div>

        <h1 class="text-4xl font-extrabold text-center mb-2 text-indigo-400 drop-shadow-md">
            <span id="form-title">Welcome to</span> <span class="text-white">MangaVerse</span>
        </h1>
        <p id="form-subtitle" class="text-center text-gray-400 mb-6">Sign in to continue your manga journey 📖</p>

        <!-- Success Messages -->
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-300 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages from Session -->
        @if (session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-300 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Error Messages from Validation -->
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Login Form -->
        <form id="login-form" method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Password</label>
                <input type="password" name="password" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-lg transition duration-200 shadow-md">
                Login
            </button>
        </form>

        <!-- Register Form -->
        <form id="register-form" method="POST" action="{{ route('register.submit') }}" class="space-y-5 hidden">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Password</label>
                <input type="password" name="password" required minlength="6"
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-lg transition duration-200 shadow-md">
                Create Account
            </button>
        </form>

        <!-- Admin Register Form -->
        <form id="admin-form" method="POST" action="{{ route('register.submit') }}" class="space-y-5 hidden">
            @csrf
            <input type="hidden" name="is_admin" value="1">
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Password</label>
                <input type="password" name="password" required minlength="6"
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:outline-none focus:border-indigo-400 transition">
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-lg transition duration-200 shadow-md">
                Create Admin Account
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('login-btn');
            const registerBtn = document.getElementById('register-btn');
            const adminBtn = document.getElementById('admin-btn');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const adminForm = document.getElementById('admin-form');
            const formTitle = document.getElementById('form-title');
            const formSubtitle = document.getElementById('form-subtitle');

            function showLogin() {
                // Update navigation tabs
                loginBtn.classList.add('bg-indigo-600', 'text-white', 'shadow');
                loginBtn.classList.remove('text-gray-400');
                registerBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                registerBtn.classList.add('text-gray-400');
                adminBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                adminBtn.classList.add('text-gray-400');
                
                // Update forms
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                adminForm.classList.add('hidden');
                
                // Update text content
                formTitle.textContent = 'Welcome to';
                formSubtitle.textContent = 'Sign in to continue your manga journey 📖';
            }

            function showRegister() {
                // Update navigation tabs
                registerBtn.classList.add('bg-indigo-600', 'text-white', 'shadow');
                registerBtn.classList.remove('text-gray-400');
                loginBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                loginBtn.classList.add('text-gray-400');
                adminBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                adminBtn.classList.add('text-gray-400');
                
                // Update forms
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                adminForm.classList.add('hidden');
                
                // Update text content
                formTitle.textContent = 'Join';
                formSubtitle.textContent = 'Create your account and start reading epic manga adventures ⚡';
            }

            function showAdmin() {
                // Update navigation tabs
                adminBtn.classList.add('bg-indigo-600', 'text-white', 'shadow');
                adminBtn.classList.remove('text-gray-400');
                loginBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                loginBtn.classList.add('text-gray-400');
                registerBtn.classList.remove('bg-indigo-600', 'text-white', 'shadow');
                registerBtn.classList.add('text-gray-400');
                
                // Update forms
                adminForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                registerForm.classList.add('hidden');
                
                // Update text content
                formTitle.textContent = 'Admin Registration';
                formSubtitle.textContent = 'Create an administrator account 🔐';
            }

            // Event listeners
            loginBtn.addEventListener('click', showLogin);
            registerBtn.addEventListener('click', showRegister);
            adminBtn.addEventListener('click', showAdmin);

            // Show appropriate form based on validation errors, session, or URL parameter
            @if($errors->any() && old('is_admin'))
                showAdmin();
            @elseif($errors->any() && old('name'))
                showRegister();
            @elseif(session('show_register') || request()->has('show') && request('show') === 'register')
                showRegister();
            @elseif(request()->has('show') && request('show') === 'admin')
                showAdmin();
            @else
                showLogin();
            @endif
        });
    </script>
</body>
</html>
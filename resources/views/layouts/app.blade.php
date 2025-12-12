<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangaverse</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300..700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#a413ec",
                        "background-light": "#f7f6f8",
                        "background-dark": "#1c1022",
                    },
                    fontFamily: {
                        "display": ["Spline Sans"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body
    class="bg-background-light dark:bg-background-dark text-gray-800 dark:text-white font-display min-h-screen flex flex-col">

    <nav class="bg-[#2b1933] border-b border-[#553267]">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-primary">Mangaverse</h1>

            <div class="flex items-center space-x-4">
                @auth
                    <form action="{{ route('manga.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="Search manga..."
                            class="px-3 py-2 rounded-l-lg bg-[#1c1122] border border-[#553267] text-white placeholder-[#b792c9] focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-r-lg font-semibold border border-primary transition-colors">
                            Search
                        </button>
                    </form>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-[#b792c9] hover:text-white font-medium px-4 py-2 rounded transition-colors flex items-center">
                            <span class="material-symbols-outlined mr-1">logout</span>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#b792c9] hover:text-white px-3 transition-colors">Login</a>
                    <a href="{{ route('register') }}"
                        class="text-[#b792c9] hover:text-white px-3 transition-colors">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6 w-full flex-grow">
        @yield('content')
    </main>

    <footer class="bg-[#2b1933] border-t border-[#553267] py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-[#b792c9] text-sm">
            &copy; {{ date('Y') }} Mangaverse. All rights reserved.
        </div>
    </footer>

</body>

</html>
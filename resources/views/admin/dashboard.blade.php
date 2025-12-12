@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-gray-400">Welcome back, {{ Auth::user()->name }}!</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-[#2b1933] rounded-xl border border-[#553267] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Total Users</p>
                        <p class="text-3xl font-bold text-white">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-primary/20 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-2xl">people</span>
                    </div>
                </div>
            </div>

            <!-- Total Admins -->
            <div class="bg-[#2b1933] rounded-xl border border-[#553267] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Admins</p>
                        <p class="text-3xl font-bold text-white">{{ $totalAdmins }}</p>
                    </div>
                    <div class="bg-primary/20 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-2xl">admin_panel_settings</span>
                    </div>
                </div>
            </div>

            <!-- Total Mangas -->
            <div class="bg-[#2b1933] rounded-xl border border-[#553267] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Total Mangas</p>
                        <p class="text-3xl font-bold text-white">{{ $totalMangas }}</p>
                    </div>
                    <div class="bg-primary/20 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-2xl">auto_stories</span>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-[#2b1933] rounded-xl border border-[#553267] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Categories</p>
                        <p class="text-3xl font-bold text-white">{{ $totalCategories }}</p>
                    </div>
                    <div class="bg-primary/20 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-2xl">category</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-[#2b1933] rounded-xl border border-[#553267] p-6">
            <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('category.create') }}" 
                   class="flex items-center gap-3 p-4 bg-[#1c1122] rounded-lg border border-[#553267] hover:border-primary transition-colors">
                    <span class="material-symbols-outlined text-primary">add</span>
                    <span class="text-white font-medium">Add Category</span>
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 p-4 bg-[#1c1122] rounded-lg border border-[#553267] hover:border-primary transition-colors">
                    <span class="material-symbols-outlined text-primary">dashboard</span>
                    <span class="text-white font-medium">View Dashboard</span>
                </a>
                <a href="{{ route('manga.index') }}" 
                   class="flex items-center gap-3 p-4 bg-[#1c1122] rounded-lg border border-[#553267] hover:border-primary transition-colors">
                    <span class="material-symbols-outlined text-primary">book</span>
                    <span class="text-white font-medium">Browse Mangas</span>
                </a>
            </div>
        </div>
    </div>
@endsection
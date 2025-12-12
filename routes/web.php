<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

// 🔹 Redirect root to login page (always)
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔹 Login route (accessible to everyone)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// 🔹 Authentication routes (only for guests)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Routes accessible to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MangaController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Manga browsing (for all authenticated users)
    Route::get('/manga', [MangaController::class, 'index'])->name('manga.index');
    Route::get('/manga/{id}', [MangaController::class, 'show'])->name('manga.show');

    // Admin routes (only for admins)
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Category management
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});

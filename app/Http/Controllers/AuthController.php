<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔹 Show Login Page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🔹 Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect admin users to admin dashboard
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ]);
    }

    // 🔹 Show Register Page (redirects to login page with register tab)
    public function showRegisterForm()
    {
        return redirect()->route('login')->with('show_register', true);
    }

    // 🔹 Handle Registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'is_admin' => 'nullable|boolean'
        ]);

        $isAdmin = $request->has('is_admin') && $request->is_admin == '1';

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $isAdmin,
        ]);

        $message = $isAdmin 
            ? 'Admin account created successfully! Please login to continue.'
            : 'Account created successfully! Please login to continue.';

        return redirect()->route('login')->with('success', $message);
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

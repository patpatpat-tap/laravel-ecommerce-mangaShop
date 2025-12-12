<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // Store intended URL and redirect to login
            return redirect()->route('login')->with('error', 'Please login to access the admin dashboard.');
        }

        // Check the Model's 'is_admin' column
        $isAdmin = $user->is_admin ?? false;

        if (!$isAdmin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden'], 403); // STOP! Show 403 error.
            }
            abort(403, 'Access denied.');
        }

        return $next($request); //GO! Pass to the controller.
    }
}

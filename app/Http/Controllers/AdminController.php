<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'low_stock_products' => Product::where('stock', '<', 10)->where('stock', '>', 0)->count(),
            'out_of_stock_products' => Product::where('stock', 0)->count(),
            'total_users' => User::where('is_admin', false)->count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'monthly_revenue' => Order::where('status', '!=', 'cancelled')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total_amount'),
            'recent_orders' => Order::with('user')->latest()->take(10)->get(),
            'recent_products' => Product::with('category')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function orders(Request $request)
    {
        $query = Order::with('user', 'items.product');

        // Search by order number or user name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function users()
    {
        $users = User::where('is_admin', false)
            ->with('orders')
            ->latest()
            ->paginate(15);
        return view('admin.users.index', compact('users'));
    }
}

@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .stat-card {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        padding: 2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        border-color: var(--gold);
    }
    .table-container {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .table-header {
        background-color: var(--warm-beige);
        border-bottom: 2px solid var(--gold-outline);
    }
</style>

<!-- Dashboard Header Section -->
<section class="w-full py-12 mb-8" style="background-color: #000000; border-bottom: 2px solid var(--gold-outline);">
    <div class="mx-auto" style="max-width: 1400px; padding: 2rem;">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--gold);">
            Admin Dashboard
        </h1>
        <p class="text-lg" style="color: var(--gold); opacity: 0.9;">
            Manage your manga shop with ease
        </p>
    </div>
</section>

<!-- Stats Cards Section -->
<div class="mx-auto mb-8" style="max-width: 1400px; padding: 0 2rem;">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card">
            <h3 class="text-sm font-medium mb-2" style="color: var(--text-light);">Total Orders</h3>
            <p class="text-4xl font-bold" style="color: var(--gold);">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="stat-card">
            <h3 class="text-sm font-medium mb-2" style="color: var(--text-light);">Pending Orders</h3>
            <p class="text-4xl font-bold" style="color: var(--red);">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="stat-card">
            <h3 class="text-sm font-medium mb-2" style="color: var(--text-light);">Total Products</h3>
            <p class="text-4xl font-bold" style="color: var(--gold);">{{ $stats['total_products'] }}</p>
        </div>
        <div class="stat-card">
            <h3 class="text-sm font-medium mb-2" style="color: var(--text-light);">Total Users</h3>
            <p class="text-4xl font-bold" style="color: var(--gold);">{{ $stats['total_users'] }}</p>
        </div>
    </div>
</div>

<!-- Recent Orders Table Section -->
<div class="mx-auto" style="max-width: 1400px; padding: 0 2rem;">
    <div class="table-container">
        <div class="table-header p-6">
            <h2 class="text-2xl font-bold" style="color: var(--gold);">Recent Orders</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y" style="border-color: var(--gold-outline);">
                <thead style="background-color: var(--warm-beige);">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Order Number</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="background-color: var(--light-beige); border-color: var(--gold-outline);">
                    @foreach($stats['recent_orders'] as $order)
                        <tr class="hover:bg-opacity-50" style="background-color: rgba(255, 255, 255, 0.3);">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: var(--text-dark);">
                                {{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                                {{ $order->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--gold);">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border-2
                                    @if($order->status === 'completed') 
                                        style="border-color: #22c55e; background-color: rgba(34, 197, 94, 0.1); color: #22c55e;"
                                    @elseif($order->status === 'shipped') 
                                        style="border-color: #3b82f6; background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;"
                                    @elseif($order->status === 'paid') 
                                        style="border-color: var(--gold); background-color: rgba(212, 175, 55, 0.1); color: var(--gold);"
                                    @elseif($order->status === 'pending') 
                                        style="border-color: var(--red); background-color: rgba(239, 27, 49, 0.1); color: var(--red);"
                                    @else 
                                        style="border-color: var(--red); background-color: rgba(239, 27, 49, 0.1); color: var(--red);"
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


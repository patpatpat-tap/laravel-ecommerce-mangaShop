@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<style>
    .orders-page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    .orders-header {
        margin-bottom: 2.5rem;
    }
    .orders-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        opacity: 0.85;
    }
    .orders-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    .status-shipped {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    .status-paid {
        background: rgba(212, 175, 55, 0.1);
        color: var(--gold);
    }
    .status-pending {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
    }
    .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    .view-button {
        padding: 0.5rem 1rem;
        background: var(--gold);
        color: var(--text-dark);
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    .view-button:hover {
        background: var(--dark-gold);
        transform: translateY(-1px);
    }
</style>

<div class="orders-page-container">
    <div class="orders-header">
        <h1 class="orders-title">My Orders</h1>
        <p class="orders-subtitle">View and track your order history</p>
    </div>

    @if($orders->count() > 0)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full" style="border-collapse: collapse;">
                <thead style="background: rgba(0, 0, 0, 0.02);">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium" style="color: var(--text-light); opacity: 0.85; font-weight: 500; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">Order Number</th>
                        <th class="px-6 py-4 text-left text-sm font-medium" style="color: var(--text-light); opacity: 0.85; font-weight: 500; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-medium" style="color: var(--text-light); opacity: 0.85; font-weight: 500; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-medium" style="color: var(--text-light); opacity: 0.85; font-weight: 500; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-medium" style="color: var(--text-light); opacity: 0.85; font-weight: 500; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.05); transition: all 0.2s;" onmouseover="this.style.background='rgba(0, 0, 0, 0.02)'" onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4 text-sm" style="color: var(--text-dark); opacity: 0.9; font-weight: 500;">
                                {{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 text-sm" style="color: var(--text-light); opacity: 0.85;">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm" style="color: var(--gold); opacity: 0.9; font-weight: 600;">
                                ₱{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge 
                                    @if($order->status === 'completed') status-completed
                                    @elseif($order->status === 'shipped') status-shipped
                                    @elseif($order->status === 'paid') status-paid
                                    @elseif($order->status === 'pending') status-pending
                                    @else status-cancelled
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order) }}" class="view-button">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem;">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
            <p class="text-xl mb-6" style="font-family: 'Poppins', 'Inter', sans-serif; font-weight: 500; color: var(--text-light); opacity: 0.85;">You have no orders yet.</p>
            <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 inline-block font-semibold transition-all duration-200 hover:scale-105" style="font-family: 'Poppins', 'Inter', sans-serif;">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection


@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>

    /* Stat Cards */
    .stat-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 249, 246, 0.98) 100%);
        border: 2px solid rgba(212, 175, 55, 0.2);
        border-radius: 14px;
        padding: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gold) 0%, var(--dark-gold) 100%);
        transform: scaleX(0);
        transition: transform 0.4s;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        border-color: var(--gold);
    }
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.875rem;
        transition: all 0.4s;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .stat-icon.gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
    }
    .stat-icon.red {
        background: linear-gradient(135deg, var(--red) 0%, var(--dark-red) 100%);
    }
    .stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }
    .stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .stat-icon svg {
        width: 24px;
        height: 24px;
        color: white;
    }
    .stat-label {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-light);
        margin-bottom: 0.625rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .stat-value {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.875rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.375rem;
        letter-spacing: -0.02em;
    }
    .stat-value.gold {
        color: var(--gold);
    }
    .stat-value.red {
        color: var(--red);
    }
    .stat-value.blue {
        color: #3b82f6;
    }
    .stat-value.green {
        color: #10b981;
    }
    .stat-sublabel {
        font-size: 0.75rem;
        color: var(--text-light);
        opacity: 0.75;
        font-weight: 400;
        margin-top: 0.375rem;
    }

    /* Table Section */
    .table-section {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 249, 246, 0.98) 100%);
        border: 2px solid rgba(212, 175, 55, 0.2);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-top: 1.5rem;
    }
    .table-header {
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.05) 100%);
        padding: 1.125rem 1.5rem;
        border-bottom: 2px solid rgba(212, 175, 55, 0.2);
    }
    .table-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    .table-title svg {
        width: 24px;
        height: 24px;
        color: var(--gold);
    }
    .table-wrapper {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
        background: rgba(0, 0, 0, 0.02);
    }
    .table th {
        padding: 0.875rem 1.25rem;
        text-align: left;
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid rgba(0, 0, 0, 0.08);
    }
    .table tbody tr {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }
    .table tbody tr:hover {
        background: rgba(212, 175, 55, 0.05);
    }
    .table td {
        padding: 1rem 1.25rem;
        font-size: 0.9375rem;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        border: 2px solid;
    }
    .status-completed {
        background: rgba(34, 197, 94, 0.1);
        border-color: #22c55e;
        color: #22c55e;
    }
    .status-shipped {
        background: rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .status-paid {
        background: rgba(212, 175, 55, 0.1);
        border-color: var(--gold);
        color: var(--gold);
    }
    .status-pending {
        background: rgba(239, 27, 49, 0.1);
        border-color: var(--red);
        color: var(--red);
    }
    .status-cancelled {
        background: rgba(107, 114, 128, 0.1);
        border-color: #6b7280;
        color: #6b7280;
    }
</style>

<!-- Stats Cards Section -->
<div class="mx-auto mb-8" style="max-width: 1400px; padding: 0 2rem;">
    <!-- Primary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Total Orders -->
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                </svg>
            </div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value gold">{{ $stats['total_orders'] }}</div>
            <div class="stat-sublabel">{{ $stats['completed_orders'] }} completed</div>
        </div>

        <!-- Pending Orders -->
        <div class="stat-card">
            <div class="stat-icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-label">Pending Orders</div>
            <div class="stat-value red">{{ $stats['pending_orders'] }}</div>
            <div class="stat-sublabel">Requires attention</div>
        </div>

        <!-- Total Revenue -->
        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value green">₱{{ number_format($stats['total_revenue'], 2) }}</div>
            <div class="stat-sublabel">₱{{ number_format($stats['monthly_revenue'], 2) }} this month</div>
        </div>

        <!-- Total Users -->
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value blue">{{ $stats['total_users'] }}</div>
            <div class="stat-sublabel">Registered customers</div>
        </div>
    </div>
    
    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Total Products -->
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="stat-label">Total Products</div>
            <div class="stat-value gold">{{ $stats['total_products'] }}</div>
            <div class="stat-sublabel">{{ $stats['active_products'] }} active</div>
        </div>

        <!-- Low Stock -->
        <div class="stat-card">
            <div class="stat-icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="stat-label">Low Stock</div>
            <div class="stat-value red">{{ $stats['low_stock_products'] }}</div>
            <div class="stat-sublabel">Less than 10 units</div>
        </div>

        <!-- Out of Stock -->
        <div class="stat-card">
            <div class="stat-icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <div class="stat-label">Out of Stock</div>
            <div class="stat-value red">{{ $stats['out_of_stock_products'] }}</div>
            <div class="stat-sublabel">Needs restocking</div>
        </div>
    </div>
</div>

<!-- Recent Orders Table Section -->
<div class="mx-auto mb-6" style="max-width: 1400px; padding: 0 2rem;">
    <div class="table-section">
        <div class="table-header">
            <h2 class="table-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                </svg>
                Recent Orders
            </h2>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_orders'] as $order)
                        <tr>
                            <td style="font-weight: 600; color: var(--text-dark);">
                                {{ $order->order_number }}
                            </td>
                            <td style="color: var(--text-light);">
                                {{ $order->user->name }}
                            </td>
                            <td style="font-weight: 700; color: var(--gold); font-size: 1.125rem;">
                                ₱{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td>
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
                            <td style="color: var(--text-light);">
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

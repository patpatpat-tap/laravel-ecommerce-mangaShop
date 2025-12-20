@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<style>
    .orders-table {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .table-header-bg {
        background-color: var(--warm-beige);
        border-bottom: 2px solid var(--gold-outline);
    }
    .search-filter-box {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Search and Filter Section -->
<div class="search-filter-box">
    <form method="GET" action="{{ route('admin.orders') }}" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label for="search" class="block text-sm font-medium mb-1" style="color: var(--text-dark);">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Order number, user name, or email..."
                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-0" 
                style="border-color: var(--gold-outline); background-color: white;">
        </div>
        <div class="min-w-[150px]">
            <label for="status" class="block text-sm font-medium mb-1" style="color: var(--text-dark);">Status</label>
            <select name="status" id="status" 
                class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-0"
                style="border-color: var(--gold-outline); background-color: white;">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="ready_to_ship" {{ request('status') === 'ready_to_ship' ? 'selected' : '' }}>Ready to Ship</option>
                <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div>
            <button type="submit" class="px-6 py-2 rounded-lg font-semibold transition-all" style="background-color: var(--gold); color: var(--text-dark); border: 2px solid var(--gold-outline);" onmouseover="this.style.backgroundColor='var(--dark-gold)'" onmouseout="this.style.backgroundColor='var(--gold)'">
                Filter
            </button>
        </div>
        @if(request('search') || request('status'))
            <div>
                <a href="{{ route('admin.orders') }}" class="px-6 py-2 rounded-lg font-semibold transition-all inline-block" style="background-color: var(--text-light); color: white; border: 2px solid var(--text-light);" onmouseover="this.style.backgroundColor='var(--text-dark)'" onmouseout="this.style.backgroundColor='var(--text-light)'">
                    Clear
                </a>
            </div>
        @endif
    </form>
</div>

<div class="orders-table">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y" style="border-color: var(--gold-outline);">
            <thead class="table-header-bg">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Order Number</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Items</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="background-color: var(--light-beige); border-color: var(--gold-outline);">
                @forelse($orders as $order)
                    <tr class="hover:bg-opacity-50" style="background-color: rgba(255, 255, 255, 0.3);">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: var(--text-dark);">
                            {{ $order->order_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium" style="color: var(--text-dark);">{{ $order->user->name }}</div>
                            <div class="text-xs" style="color: var(--text-light);">{{ $order->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $order->items->sum('quantity') }} item(s)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--gold);">
                            ₱{{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                    class="text-xs px-3 py-1 rounded-md border-2 focus:outline-none focus:ring-2 transition-colors
                                    @if($order->status === 'completed') border-green-500 bg-green-50 text-green-800
                                    @elseif($order->status === 'shipped') border-blue-500 bg-blue-50 text-blue-800
                                    @elseif($order->status === 'ready_to_ship') border-purple-500 bg-purple-50 text-purple-800
                                    @elseif($order->status === 'paid') border-yellow-500 bg-yellow-50 text-yellow-800
                                    @elseif($order->status === 'pending') border-red-500 bg-red-50 text-red-800
                                    @else border-gray-500 bg-gray-50 text-gray-800
                                    @endif">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="ready_to_ship" {{ $order->status === 'ready_to_ship' ? 'selected' : '' }}>Ready to Ship</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $order->created_at->format('M d, Y') }}
                            <div class="text-xs">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('orders.show', $order) }}" class="px-3 py-1 rounded transition-colors" style="color: var(--gold); background-color: rgba(212, 175, 55, 0.1);" onmouseover="this.style.backgroundColor='rgba(212, 175, 55, 0.2)'" onmouseout="this.style.backgroundColor='rgba(212, 175, 55, 0.1)'">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center" style="color: var(--text-light);">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection


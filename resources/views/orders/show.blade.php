@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<style>
    .order-details-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    .order-details-header {
        margin-bottom: 2.5rem;
    }
    .order-details-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        opacity: 0.85;
    }
    .order-details-subtitle {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .order-info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .order-info-card h2 {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.85;
        margin-bottom: 1.25rem;
    }
    .order-info-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .order-info-item:last-child {
        border-bottom: none;
    }
    .order-info-label {
        font-size: 0.95rem;
        font-weight: 400;
        color: var(--text-light);
        opacity: 0.85;
    }
    .order-info-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.9;
    }
    .order-item-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    .order-item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        flex-shrink: 0;
        overflow: hidden;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .order-item-title {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0.25rem;
    }
    .order-item-details {
        font-size: 0.95rem;
        color: var(--text-light);
        opacity: 0.75;
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
    .status-ready-to-ship {
        background: rgba(147, 51, 234, 0.1);
        color: #9333ea;
    }
    .status-pending {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
    }
    .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    /* QA Status Styling */
    .qa-status-container {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }
    .qa-status-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-light);
        opacity: 0.85;
        margin-bottom: 0.5rem;
        display: block;
        font-family: 'Poppins', 'Inter', sans-serif;
    }
    .qa-status-select {
        width: 100%;
        padding: 0.625rem 1rem;
        padding-right: 2.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-dark);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        font-family: 'Poppins', 'Inter', sans-serif;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    .qa-status-select:hover:not(:disabled) {
        border-color: #d1d5db;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        transform: translateY(-1px);
    }
    .qa-status-select:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15), 0 2px 6px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }
    .qa-status-select:disabled {
        cursor: not-allowed;
        opacity: 0.6;
        background-color: #f9fafb;
    }
    .qa-status-select option {
        padding: 0.5rem;
        font-weight: 500;
    }
    .qa-status-select option[value="pending"] {
        color: #6b7280;
    }
    .qa-status-select option[value="approved"] {
        color: #10b981;
    }
    .qa-status-select option[value="rejected"] {
        color: #ef4444;
    }
    .qa-feedback {
        display: inline-block;
        margin-left: 0.75rem;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        font-family: 'Poppins', 'Inter', sans-serif;
        transition: all 0.3s ease;
    }
    .qa-feedback.success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    .qa-feedback.error {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    .qa-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        font-family: 'Poppins', 'Inter', sans-serif;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .qa-status-badge.pending {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
    }
    .qa-status-badge.approved {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    .qa-status-badge.rejected {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
</style>

<script>
function updateQAStatus(itemId, status) {
    const feedbackEl = document.getElementById('qa-feedback-' + itemId);
    const badgeEl = document.getElementById('qa-badge-' + itemId);
    const selectEl = document.querySelector(`select[onchange*="${itemId}"]`);
    
    // Disable select during update
    selectEl.disabled = true;
    selectEl.style.opacity = '0.6';
    
    // Clear previous feedback
    feedbackEl.textContent = '';
    feedbackEl.className = 'qa-feedback';
    
    fetch('/admin/order-items/' + itemId + '/qa-status', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ qa_status: status })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Failed to update QA status');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update select border color based on status
            const statusColors = {
                'pending': { border: '#e5e7eb', text: '#6b7280', icon: '⏳', label: 'Pending' },
                'approved': { border: '#10b981', text: '#10b981', icon: '✅', label: 'Approved' },
                'rejected': { border: '#ef4444', text: '#ef4444', icon: '❌', label: 'Rejected' }
            };
            const colors = statusColors[status] || statusColors['pending'];
            selectEl.style.borderColor = colors.border;
            selectEl.style.color = colors.text;
            
            // Update badge
            badgeEl.className = 'qa-status-badge ' + status;
            badgeEl.textContent = colors.icon + ' ' + colors.label;
            
            // Show success feedback
            feedbackEl.textContent = '✓ Updated successfully';
            feedbackEl.className = 'qa-feedback success';
            
            // Update stored original status
            selectEl.setAttribute('data-original-status', status);
            
            // Hide feedback after 3 seconds
            setTimeout(() => {
                feedbackEl.textContent = '';
                feedbackEl.className = 'qa-feedback';
            }, 3000);
        } else {
            throw new Error(data.message || 'Failed to update QA status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        feedbackEl.textContent = '✗ ' + (error.message || 'Update failed');
        feedbackEl.className = 'qa-feedback error';
        
        // Revert select value
        const originalStatus = selectEl.getAttribute('data-original-status') || 'pending';
        selectEl.value = originalStatus;
        
        // Revert badge
        const statusLabels = {
            'pending': { icon: '⏳', label: 'Pending' },
            'approved': { icon: '✅', label: 'Approved' },
            'rejected': { icon: '❌', label: 'Rejected' }
        };
        const label = statusLabels[originalStatus] || statusLabels['pending'];
        badgeEl.className = 'qa-status-badge ' + originalStatus;
        badgeEl.textContent = label.icon + ' ' + label.label;
        
        // Hide error after 5 seconds
        setTimeout(() => {
            feedbackEl.textContent = '';
            feedbackEl.className = 'qa-feedback';
        }, 5000);
    })
    .finally(() => {
        // Re-enable select
        selectEl.disabled = false;
        selectEl.style.opacity = '1';
    });
}

// Store original status on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.qa-status-select').forEach(select => {
        select.setAttribute('data-original-status', select.value);
    });
});
</script>

<div class="order-details-container">
    <div class="order-details-header">
        <h1 class="order-details-title">Order Details</h1>
        <p class="order-details-subtitle">Review the mangas included in this order and your delivery information.</p>
        <p style="font-size: 0.9rem; color: var(--text-light); opacity: 0.75; margin-top: 0.5rem;">Order placed on {{ $order->created_at->format('F d, Y h:i A') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Order + shipping summary -->
            <div>
            <div class="order-info-card">
                <h2>Order Summary</h2>
                <div class="order-info-item">
                    <span class="order-info-label">Order Number</span>
                    <div class="order-info-value" style="font-weight: 600; margin-top: 0.25rem;">{{ $order->order_number }}</div>
                </div>
                <div class="order-info-item">
                    <span class="order-info-label">Total Amount</span>
                    <div class="order-info-value" style="font-size: 1.25rem; font-weight: 600; color: var(--gold); opacity: 0.9; margin-top: 0.25rem;">₱{{ number_format($order->total_amount, 2) }}</div>
                </div>
                <div class="order-info-item">
                    <span class="order-info-label">Status</span>
                    <div style="margin-top: 0.5rem;">
                        <span class="status-badge 
                            @if($order->status === 'completed') status-completed
                            @elseif($order->status === 'shipped') status-shipped
                            @elseif($order->status === 'ready_to_ship') status-ready-to-ship
                            @elseif($order->status === 'paid') status-paid
                            @elseif($order->status === 'pending') status-pending
                            @else status-cancelled
                        @endif">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                    </span>
                    </div>
                </div>
            </div>

            <div class="order-info-card">
                <h2>Delivery Details</h2>
                <div class="order-info-item">
                    <div class="order-info-value" style="margin-top: 0.25rem;">{{ $order->shipping_address }}</div>
                </div>
                <div class="order-info-item">
                    <div class="order-info-value" style="margin-top: 0.25rem;">
                        {{ $order->shipping_city }}
                        @if($order->shipping_state) · {{ $order->shipping_state }} @endif
                        {{ $order->shipping_postal_code }}
                    </div>
                </div>
                <div class="order-info-item">
                    <div class="order-info-value" style="margin-top: 0.25rem;">{{ $order->shipping_country }}</div>
                </div>
                @if($order->phone)
                    <div class="order-info-item">
                        <span class="order-info-label">Phone</span>
                        <div class="order-info-value" style="margin-top: 0.25rem;">{{ $order->phone }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Order items -->
        <div class="lg:col-span-2">
            <div class="order-info-card">
                <h2>
                    <i class="fas fa-shopping-bag mr-2" style="color: var(--gold); opacity: 0.9;"></i>Manga Items
                </h2>

                <div>
                    @foreach($order->items as $item)
                        <div class="order-item-card flex items-center gap-4">
                            <!-- Manga Image -->
                            <div class="order-item-image">
                                @if($item->product?->image)
                                    <img src="{{ $item->product->image }}"
                                         alt="{{ $item->product->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-teal-400 text-2xl font-bold">
                                        {{ mb_substr($item->product?->name ?? 'MG', 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Manga details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="order-item-title">{{ $item->product?->name }}</h3>
                                <p class="order-item-details">
                                    {{ $item->product?->author }}
                                    {!! $item->product?->publisher ? ' · '.$item->product->publisher : '' !!}
                                </p>
                                @if($item->product?->category)
                                    <span class="inline-block mt-2 px-3 py-1 bg-teal-100 text-teal-700 text-sm font-medium rounded-full">
                                        {{ $item->product->category->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Price & quantity -->
                            <div class="text-right" style="min-width: 120px;">
                                <div style="font-size: 0.95rem; color: var(--text-light); opacity: 0.75; margin-bottom: 0.5rem;">
                                    Quantity: <span style="font-weight: 500; opacity: 0.9;">{{ $item->quantity }}</span>
                                </div>
                                <div style="font-size: 0.95rem; color: var(--text-light); opacity: 0.75; margin-bottom: 0.5rem;">
                                    ₱{{ number_format($item->price, 2) }} each
                                </div>
                                <div style="font-size: 1.5rem; color: var(--gold); font-weight: 500; opacity: 0.9; margin-bottom: 0.75rem;">
                                    ₱{{ number_format($item->subtotal, 2) }}
    </div>

                                @auth
                                    @if(Auth::user()->is_admin)
                                        <div class="qa-status-container">
                                            <label class="qa-status-label">
                                                <i class="fas fa-check-circle mr-1" style="opacity: 0.7;"></i>QA Status
                                            </label>
                                            <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                                                <select class="qa-status-select" 
                                                        value="{{ $item->qa_status ?? 'pending' }}"
                                                        onchange="updateQAStatus({{ $item->id }}, this.value)"
                                                        style="flex: 1; min-width: 150px; border-color: {{ ($item->qa_status ?? 'pending') === 'approved' ? '#10b981' : (($item->qa_status ?? 'pending') === 'rejected' ? '#ef4444' : '#e5e7eb') }}; color: {{ ($item->qa_status ?? 'pending') === 'approved' ? '#10b981' : (($item->qa_status ?? 'pending') === 'rejected' ? '#ef4444' : '#6b7280') }};">
                                                    <option value="pending" {{ ($item->qa_status ?? 'pending') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                    <option value="approved" {{ ($item->qa_status ?? 'pending') === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                                                    <option value="rejected" {{ ($item->qa_status ?? 'pending') === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                                </select>
                                                <span class="qa-status-badge {{ $item->qa_status ?? 'pending' }}" id="qa-badge-{{ $item->id }}">
                                                    @if(($item->qa_status ?? 'pending') === 'approved')
                                                        ✅ Approved
                                                    @elseif(($item->qa_status ?? 'pending') === 'rejected')
                                                        ❌ Rejected
                                                    @else
                                                        ⏳ Pending
                                                    @endif
                                                </span>
                                            </div>
                                            <div style="margin-top: 0.5rem;">
                                                <span id="qa-feedback-{{ $item->id }}" class="qa-feedback"></span>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


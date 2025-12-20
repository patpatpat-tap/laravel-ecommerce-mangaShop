@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<style>
    .product-table {
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
    .btn-primary {
        background-color: var(--gold);
        color: var(--text-dark);
        border: 2px solid var(--gold-outline);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background-color: var(--dark-gold);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="mb-6">
    <a href="{{ route('admin.products.create') }}" class="btn-primary inline-block">
        + Add New Product
    </a>
</div>

<div class="product-table">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y" style="border-color: var(--gold-outline);">
            <thead class="table-header-bg">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Image</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Stock</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="background-color: var(--light-beige); border-color: var(--gold-outline);">
                @forelse($products as $product)
                    <tr class="hover:bg-opacity-50" style="background-color: rgba(255, 255, 255, 0.3);">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-16 h-20 object-cover rounded" style="border: 2px solid var(--gold-outline);">
                            @else
                                <div class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center" style="border: 2px solid var(--gold-outline);">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold" style="color: var(--text-dark);">{{ $product->name }}</div>
                            @if($product->author)
                                <div class="text-xs" style="color: var(--text-light);">by {{ $product->author }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--gold);">
                            ₱{{ number_format($product->price, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold {{ $product->stock < 10 ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $product->stock }}
                            </span>
                            @if($product->stock == 0)
                                <span class="ml-2 px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Out of Stock</span>
                            @elseif($product->stock < 10)
                                <span class="ml-2 px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border-2" style="border-color: #22c55e; background-color: rgba(34, 197, 94, 0.1); color: #22c55e;">Active</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border-2" style="border-color: var(--text-light); background-color: rgba(74, 74, 74, 0.1); color: var(--text-light);">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-1 rounded transition-colors" style="color: var(--gold); background-color: rgba(212, 175, 55, 0.1);" onmouseover="this.style.backgroundColor='rgba(212, 175, 55, 0.2)'" onmouseout="this.style.backgroundColor='rgba(212, 175, 55, 0.1)'">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded transition-colors" style="color: var(--red); background-color: rgba(239, 27, 49, 0.1);" onmouseover="this.style.backgroundColor='rgba(239, 27, 49, 0.2)'" onmouseout="this.style.backgroundColor='rgba(239, 27, 49, 0.1)'">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No products found. <a href="{{ route('admin.products.create') }}" class="text-indigo-600 hover:text-indigo-900">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection


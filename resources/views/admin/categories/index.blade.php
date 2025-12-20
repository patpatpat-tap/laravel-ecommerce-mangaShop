@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<style>
    .categories-table {
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
    <a href="{{ route('admin.categories.create') }}" class="btn-primary inline-block">
        + Add New Category
    </a>
</div>

<div class="categories-table">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y" style="border-color: var(--gold-outline);">
            <thead class="table-header-bg">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Slug</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Description</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Products</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="background-color: var(--light-beige); border-color: var(--gold-outline);">
                @forelse($categories as $category)
                    <tr class="hover:bg-opacity-50" style="background-color: rgba(255, 255, 255, 0.3);">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold" style="color: var(--text-dark);">{{ $category->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $category->slug }}
                        </td>
                        <td class="px-6 py-4 text-sm" style="color: var(--text-light);">
                            {{ \Illuminate\Support\Str::limit($category->description ?? 'No description', 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full border-2" style="border-color: var(--gold); background-color: rgba(212, 175, 55, 0.1); color: var(--gold);">
                                {{ $category->products()->count() }} products
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.categories.show', $category) }}" class="px-3 py-1 rounded transition-colors" style="color: var(--gold); background-color: rgba(212, 175, 55, 0.1);" onmouseover="this.style.backgroundColor='rgba(212, 175, 55, 0.2)'" onmouseout="this.style.backgroundColor='rgba(212, 175, 55, 0.1)'">View</a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1 rounded transition-colors" style="color: var(--gold); background-color: rgba(212, 175, 55, 0.1);" onmouseover="this.style.backgroundColor='rgba(212, 175, 55, 0.2)'" onmouseout="this.style.backgroundColor='rgba(212, 175, 55, 0.1)'">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded transition-colors" style="color: var(--red); background-color: rgba(239, 27, 49, 0.1);" onmouseover="this.style.backgroundColor='rgba(239, 27, 49, 0.2)'" onmouseout="this.style.backgroundColor='rgba(239, 27, 49, 0.1)'">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center" style="color: var(--text-light);">
                            No categories found. <a href="{{ route('admin.categories.create') }}" style="color: var(--gold);">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection


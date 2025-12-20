@extends('layouts.admin')

@section('title', 'Category Details')
@section('page-title', 'Category Details')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="mb-6">
        <h3 class="text-2xl font-bold mb-2" style="color: var(--text-dark);">{{ $category->name }}</h3>
        <p class="text-sm text-gray-500 mb-4">Slug: {{ $category->slug }}</p>
        @if($category->description)
            <p class="text-gray-700">{{ $category->description }}</p>
        @else
            <p class="text-gray-500 italic">No description provided.</p>
        @endif
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('admin.categories.edit', $category) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Edit Category
        </a>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
            Back to Categories
        </a>
    </div>
</div>

@if($category->products->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h4 class="text-lg font-semibold" style="color: var(--text-dark);">
                Products in this Category ({{ $category->products->count() }})
            </h4>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($category->products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $product->stock }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-center">No products in this category yet.</p>
    </div>
@endif
@endsection








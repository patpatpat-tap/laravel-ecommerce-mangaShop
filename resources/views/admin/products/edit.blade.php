@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<style>
    .form-container {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .form-input {
        border: 2px solid var(--gold-outline);
        border-radius: 8px;
    }
    .form-input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    .btn-submit {
        background-color: var(--gold);
        color: var(--text-dark);
        border: 2px solid var(--gold-outline);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-submit:hover {
        background-color: var(--dark-gold);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .btn-cancel {
        background-color: var(--text-light);
        color: white;
        border: 2px solid var(--text-light);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background-color: var(--text-dark);
    }
</style>
<div class="form-container">
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category_id" id="category_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('price') border-red-500 @enderror">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $product->stock) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('stock') border-red-500 @enderror">
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $product->author) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-700 mb-1">Publisher</label>
                <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $product->publisher) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="pages" class="block text-sm font-medium text-gray-700 mb-1">Pages</label>
                <input type="number" name="pages" id="pages" min="1" value="{{ old('pages', $product->pages) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
            @if($product->image)
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-48 object-cover rounded border border-gray-300">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/jpeg,image/jpg,image/png,image/webp"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('image') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, WEBP. Max size: 5MB. Leave empty to keep current image.</p>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="btn-submit">
                Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection


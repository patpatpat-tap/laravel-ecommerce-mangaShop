@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-xl">No Image</span>
                    </div>
                @endif
            </div>
            <div class="md:w-1/2 p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-lg text-gray-600 mb-2">Category: <span class="font-semibold">{{ $product->category->name }}</span></p>
                
                @if($product->author)
                    <p class="text-gray-600 mb-2">Author: <span class="font-semibold">{{ $product->author }}</span></p>
                @endif
                
                @if($product->publisher)
                    <p class="text-gray-600 mb-2">Publisher: <span class="font-semibold">{{ $product->publisher }}</span></p>
                @endif
                
                @if($product->pages)
                    <p class="text-gray-600 mb-4">Pages: <span class="font-semibold">{{ $product->pages }}</span></p>
                @endif

                <div class="mb-6">
                    <span class="text-4xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                </div>

                @if($product->description)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Description</h2>
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>
                @endif

                <div class="mb-6">
                    <p class="text-lg">
                        Stock: 
                        @if($product->stock > 0)
                            <span class="font-semibold text-green-600">{{ $product->stock }} available</span>
                        @else
                            <span class="font-semibold text-red-600">Out of Stock</span>
                        @endif
                    </p>
                </div>

                @auth
                    @if($product->stock > 0)
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex items-center space-x-4">
                            @csrf
                            <div class="flex items-center">
                                <label for="quantity" class="mr-2">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                    class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button disabled class="px-6 py-3 bg-gray-400 text-white rounded-md cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                @else
                    <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">login</a> to add items to cart.</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection


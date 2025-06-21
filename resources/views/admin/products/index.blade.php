@extends('admin.layouts.app')

@section('title', 'Product Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Product Management</h2>
        <a href="{{ route('admin.products.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                               placeholder="Search products...">
                    </div>
                </div>
                
                <div>
                    <label for="sort" class="sr-only">Sort</label>
                    <select id="sort" name="sort" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                        <option value="">Default</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price (Low to High)</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price (High to Low)</option>
                        <option value="stock" {{ request('sort') === 'stock' ? 'selected' : '' }}>Stock Quantity</option>
                    </select>
                </div>
                
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Filter
                </button>
            </form>
        </div>

        @if($products->isEmpty())
            <div class="p-6 text-center text-gray-500">
                No products found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative pb-[75%] bg-gray-100">
                        @if($product->featured_image_url)
                            <img src="{{ Storage::url($product->featured_image_url) }}" alt="{{ $product->name }}" class="absolute h-full w-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-lg text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-primary-600">${{ number_format($product->price, 2) }}</span>
                            <span class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock_quantity }} in stock
                            </span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-3 flex justify-between">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-gray-600 hover:text-primary-600">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.products.show', $product) }}" class="text-gray-600 hover:text-primary-600">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-red-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
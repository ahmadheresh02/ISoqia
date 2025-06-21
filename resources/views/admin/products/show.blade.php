@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">Created {{ $product->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->stock_quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->stock_quantity }} in stock
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-medium mb-4">Product Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Price:</span>
                            <span class="text-gray-800">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">SKU:</span>
                            <span class="text-gray-800">{{ $product->sku ?? 'Not set' }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Status:</span>
                            <span class="text-gray-800">{{ $product->deleted_at ? 'Archived' : 'Active' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium mb-4">Product Images</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @if($product->featured_image_url)
                            <div class="relative">
                                <span class="absolute top-1 left-1 bg-primary-500 text-white text-xs px-2 py-1 rounded">Featured</span>
                                <img src="{{ Storage::url($product->featured_image_url) }}" alt="Featured image" class="h-24 w-full object-cover rounded border-2 border-primary-500">
                            </div>
                        @endif
                        @foreach($product->images as $image)
                            <img src="{{ Storage::url($image->image_url) }}" alt="Product image" class="h-24 w-full object-cover rounded border border-gray-200">
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4">Description</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4">Sales Data</h3>
                @if($product->orderItems->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($product->orderItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-600">
                                        <a href="{{ route('admin.orders.show', $item->order) }}" class="hover:underline">#{{ $item->order->id }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->order->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">This product hasn't been ordered yet.</p>
                @endif
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Products
                </a>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit Product
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
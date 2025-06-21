@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">Order #{{ $order->id }}</h2>
                    <p class="text-gray-600">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                </div>
                <div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                           ($order->status === 'shipped' ? 'bg-indigo-100 text-indigo-800' : 
                           ($order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                           'bg-red-100 text-red-800'))) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-medium mb-4">Customer Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Name:</span>
                            <span class="text-gray-800">{{ $order->user->full_name }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Email:</span>
                            <span class="text-gray-800">{{ $order->user->email }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Phone:</span>
                            <span class="text-gray-800">{{ $order->user->phone ?? 'Not provided' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium mb-4">Order Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal:</span>
                            <span class="text-gray-800">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipping:</span>
                            <span class="text-gray-800">${{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tax:</span>
                            <span class="text-gray-800">${{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-medium border-t border-gray-200 pt-2 mt-2">
                            <span class="text-gray-700">Total:</span>
                            <span class="text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4">Order Items</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded" src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                            <div class="text-sm text-gray-500">SKU: {{ $item->product->sku ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${{ number_format($item->price, 2) }}
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
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Orders
                </a>
                
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="mr-3 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
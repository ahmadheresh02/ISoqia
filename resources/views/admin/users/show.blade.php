@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $user->full_name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
                <div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-medium mb-4">User Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Full Name:</span>
                            <span class="text-gray-800">{{ $user->full_name }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Email:</span>
                            <span class="text-gray-800">{{ $user->email }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Location:</span>
                            <span class="text-gray-800">{{ $user->location ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Registered:</span>
                            <span class="text-gray-800">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Last Login:</span>
                            <span class="text-gray-800">{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium mb-4">User Statistics</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Total Orders:</span>
                            <span class="text-gray-800">{{ $user->orders_count }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Active Carts:</span>
                            <span class="text-gray-800">{{ $user->carts_count }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Total Spent:</span>
                            <span class="text-gray-800">${{ number_format($user->orders->sum('total_amount'), 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4">Recent Orders</h3>
                @if($user->orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->orders->take(5) as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-600">
                                        <a href="#" class="hover:underline">#{{ $order->id }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                               'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No orders found for this user.</p>
                @endif
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit User
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Users
                </a>
            </div>
        </div>
    </div>
@endsection
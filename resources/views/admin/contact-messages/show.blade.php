@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-4">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Back to messages
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-medium text-gray-900">Message Details</h2>
        </div>
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">From</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->email }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Package</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->package ?? 'Not specified' }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500">Title</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->title }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500">Message</h3>
                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $message->description }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Received</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $message->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                    <p class="mt-1 text-sm text-gray-900">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ is_null($message->read_at) ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ is_null($message->read_at) ? 'Unread' : 'Read on ' . $message->read_at->format('M d, Y') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Hide Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
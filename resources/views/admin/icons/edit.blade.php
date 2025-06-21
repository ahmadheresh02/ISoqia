@extends('admin.layouts.app')

@section('title', 'Edit Icon')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Edit Icon</h2>
    <a href="{{ route('admin.icons.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Icons
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.icons.update', $icon) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Icon Image</label>
                <input type="file" name="icon" id="icon" required
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Current Icon:</p>
                    <img src="{{ $icon->url }}" alt="Current Icon" class="h-20 mt-2">
                    <p class="text-sm text-gray-500 mt-1">{{ $icon->path }}</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-3 bg-gray-50 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                Update Icon
            </button>
        </div>
    </form>
</div>
@endsection
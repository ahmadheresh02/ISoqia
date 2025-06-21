@extends('admin.layouts.app')

@section('title', 'Add New Icon')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">@yield('title')</h2>
    <a href="{{ route('admin.icons.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Icons
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ isset($icon) ? route('admin.icons.update', $icon) : route('admin.icons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($icon))
            @method('PUT')
        @endif
        
        <div class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon Image</label>
                <input type="file" name="icon" id="icon" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                @if(isset($icon))
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">Current Icon:</p>
                        <img src="{{ $icon->url }}" alt="Current Icon" class="h-20 mt-2">
                    </div>
                @endif
            </div>
        </div>

        <div class="px-6 py-3 bg-gray-50 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                {{ isset($icon) ? 'Update Icon' : 'Upload Icon' }}
            </button>
        </div>
    </form>
</div>
@endsection
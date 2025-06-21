@extends('admin.layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">About Us Content</h2>
        <a href="{{ route('admin.about.edit') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit Content
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            @if($aboutUs->image_url)
                <div class="mb-6">
                    <img src="{{ Storage::url($aboutUs->image_url) }}" alt="About Us Image" class="max-w-full h-auto rounded-lg shadow">
                </div>
            @endif

            <div class="prose max-w-none">
                <h1 class="text-3xl font-bold mb-4">{{ $aboutUs->title }}</h1>
                {!! nl2br(e($aboutUs->content)) !!}
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    Last updated by: {{ $aboutUs->updatedBy->name ?? 'System' }} on 
                    {{ $aboutUs->updated_at->format('F j, Y \a\t g:i A') }}
                </p>
            </div>
        </div>
    </div>
@endsection
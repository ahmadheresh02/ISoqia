@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Create New Product</h2>
        <p class="text-gray-600">Add a new product to your store</p>
    </div>

    @include('admin.products.form', [
        'product' => null,
        'method' => 'POST',
        'action' => route('admin.products.store')
    ])
@endsection
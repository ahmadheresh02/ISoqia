@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Edit Product</h2>
        <p class="text-gray-600">Update product details</p>
    </div>

    @include('admin.products.form', [
        'product' => $product,
        'method' => 'PUT',
        'action' => route('admin.products.update', $product)
    ])
@endsection
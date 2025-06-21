@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Edit User</h2>
        <p class="text-gray-600">Update user information</p>
    </div>

    @include('admin.users.form', [
        'user' => $user,
        'method' => 'PUT',
        'action' => route('admin.users.update', $user)
    ])
@endsection

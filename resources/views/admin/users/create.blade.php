@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Create New User</h2>
        <p class="text-gray-600">Add a new user to the system</p>
    </div>

    @include('admin.users.form', [
        'user' => null,
        'method' => 'POST',
        'action' => route('admin.users.store')
    ])
@endsection
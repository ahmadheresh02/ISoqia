@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-6">
        <!-- Your dashboard stats cards here -->
        <!-- ... -->
    </div>

    <!-- Recent Orders and Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>
            <!-- ... -->
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Top Products</h3>
            <!-- ... -->
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Monthly Revenue</h3>
        <!-- ... -->
    </div>
@endsection

@push('scripts')
    <!-- Chart.js script if needed -->
@endpush
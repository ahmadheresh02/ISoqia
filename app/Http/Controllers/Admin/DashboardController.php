<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_products' => Product::whereNull('deleted_at')->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::whereIn('status', ['delivered', 'shipped'])->sum('total_amount'),
            'active_carts' => Cart::where('expires_at', '>', now())->count(),
        ];

        // Recent orders
        $recent_orders = Order::with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Top products
        $top_products = Product::withCount(['orderItems' => function ($query) {
            $query->whereHas('order', function ($q) {
                $q->whereIn('status', ['delivered', 'shipped']);
            });
        }])
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        // Monthly revenue chart data
        $monthly_revenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as revenue')
        )
            ->whereIn('status', ['delivered', 'shipped'])
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_orders', 'top_products', 'monthly_revenue'));
    }
}

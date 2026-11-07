<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = (float) Order::whereNotIn('status', ['cancelled'])->sum('total_amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'customer')->count();

        // Low stock: products with stock <= 5
        $lowStock = Product::where('stock', '<=', 5)->count();

        $unreadInquiries = Inquiry::where('is_read', false)->count();

        $statuses = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];
        $statusCounts = Order::select('status', DB::raw('COUNT(*) as aggregate'))
            ->whereIn('status', $statuses)
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $ordersByStatus = collect($statuses)->mapWithKeys(
            fn ($status) => [$status => (int) ($statusCounts[$status] ?? 0)]
        )->all();

        $recentOrders = Order::with('user')->latest('id')->take(6)->get();
        $recentProducts = Product::with('category')->latest('id')->take(6)->get();

        return view('admin.dashboard', [
            'total_revenue' => $totalRevenue,
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'total_products' => $totalProducts,
            'total_users' => $totalUsers,
            'low_stock' => $lowStock,
            'unread_inquiries' => $unreadInquiries,
            'orders_by_status' => $ordersByStatus,
            'recent_orders' => $recentOrders,
            'recent_products' => $recentProducts,
        ]);
    }
}

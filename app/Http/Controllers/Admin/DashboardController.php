<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Overview counts
        $totalUsers = User::count();
        $totalRevenue = (float) Order::sum('total_price');
        $totalOrders = Order::count();
        $totalMenuItems = Menu::count();

        // Generate labels for last 7 days (oldest → newest)
        $last7Days = collect(range(6, 0))->map(fn($d) =>
            Carbon::today()->subDays($d)->format('M d')
        )->toArray();

        // Count orders for each day
        $orderCounts = array_map(function ($label) {
            $date = Carbon::createFromFormat('M d', $label)->year(Carbon::now()->year);
            return Order::whereDate('created_at', $date)->count();
        }, $last7Days);

// ✅ Revenue Breakdown by Category
        $categoryLabels = [];
        $categoryValues = [];

        // If order_items table exists, use it for accurate category revenue
        if (
            DB::getSchemaBuilder()->hasTable('order_items') &&
            DB::getSchemaBuilder()->hasTable('menus') &&
            DB::getSchemaBuilder()->hasTable('categories')
        ) {
            $rows = DB::table('order_items')
                ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                ->join('categories', 'menus.category_id', '=', 'categories.id')
                ->select('categories.name as category', DB::raw('SUM(order_items.price * order_items.quantity) as revenue'))
                ->groupBy('categories.id', 'categories.name')
                ->orderByDesc('revenue')
                ->get();
        } else {
            // Fallback (no order_items table)
            $rows = DB::table('menus')
                ->join('categories', 'menus.category_id', '=', 'categories.id')
                ->select('categories.name as category', DB::raw('SUM(menus.price) as revenue'))
                ->groupBy('categories.id', 'categories.name')
                ->orderByDesc('revenue')
                ->get();
        }

        // Prepare arrays for Chart.js
        foreach ($rows as $r) {
            $categoryLabels[] = $r->category;
            $categoryValues[] = (float) $r->revenue;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRevenue',
            'totalOrders',
            'totalMenuItems',
            'last7Days',
            'orderCounts',
            'categoryLabels',
            'categoryValues'
        ));
    }
}

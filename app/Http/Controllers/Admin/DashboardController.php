<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = class_exists(User::class) ? User::count() : 0;
        $totalRevenue = class_exists(Order::class) ? (float) Order::sum('total_price') : 0;
        $totalOrders = class_exists(Order::class) ? Order::count() : 0;
        $totalMenuItems = class_exists(Menu::class) ? Menu::count() : 0;

        // last 7 days labels
        $last7Days = collect(range(6, 0))->map(fn($d) => Carbon::today()->subDays($d)->format('M d'))->toArray();

        // simple counts per day (replace with real query by created_at date)
        $orderCounts = collect($last7Days)->map(fn() => rand(0, 10))->toArray();

        $categoryLabels = class_exists(Category::class) ? Category::pluck('name')->toArray() : ['Food', 'Drink', 'Snack'];
        $categoryValues = array_map(fn() => rand(50, 300), $categoryLabels);

        return view('admin.dashboard', compact(
            'totalUsers','totalRevenue','totalOrders','totalMenuItems',
            'last7Days','orderCounts','categoryLabels','categoryValues'
        ));
    }
}
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        // Get data from the database
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalMenuItems = Menu::count();

        // Send data to the view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'totalMenuItems'
        ));
    }
}


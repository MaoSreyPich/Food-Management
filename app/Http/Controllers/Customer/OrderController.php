<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        // ✅ Use safe optional() helper to avoid errors if user not logged in
        $email = optional(auth()->user())->email ?? session('customer_email');

        if (!$email) {
            return redirect()
                ->route('customer.menu.index')
                ->with('error', 'Please log in or place an order first.');
        }

        // ✅ Fetch orders belonging to this customer email
        $orders = Order::where('customer_email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ Make sure this view exists: resources/views/customer/orders.blade.php
        return view('customer.orders', compact('orders'));
    }
}

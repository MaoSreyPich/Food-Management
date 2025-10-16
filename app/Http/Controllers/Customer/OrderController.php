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
        // Get the logged-in user email (if using auth)
        // or fallback to customer email stored in session (for guest checkout)
        $email = auth()->user()->email ?? session('customer_email');

        if (!$email) {
            return redirect()->route('menu.index')
                             ->with('error', 'Please log in or place an order first.');
        }

        // Fetch orders for this customer
        $orders = Order::where('customer_email', $email)
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Send to Blade view
        return view('customer.orders', compact('orders'));
    }
}

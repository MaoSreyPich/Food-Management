<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        return view('customer.checkout');
    }

    /**
     * Handle order placement.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'payment_method' => 'required|string',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total (items + delivery)
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $delivery_fee = 3.50;
        $total = $subtotal + $delivery_fee;

        DB::beginTransaction();
        try {
            // Create the order
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // Store customer email for viewing order history later
            session(['customer_email' => $request->customer_email]);

            // (Optional) Reduce stock for each ordered item
            foreach ($cart as $id => $item) {
                $menu = Menu::find($id);
                if ($menu) {
                    $menu->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while placing your order.');
        }
    }
}
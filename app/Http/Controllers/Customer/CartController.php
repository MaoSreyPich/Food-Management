<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $cart = session('cart', []);
        return view('customer.cart', compact('cart'));
    }

    /**
     * Update quantity of a specific cart item.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $quantity = max(1, (int) $request->quantity); // prevent zero or negative

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item removed successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    /**
     * Clear entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}

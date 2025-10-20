<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category; // ✅ add this line

class MenuController extends Controller
{
    /**
     * Display all menu items grouped by category.
     */
    public function index()
    {
        $categories = Category::all();

        // Show 4 random "popular" dishes
        $popularMenus = Menu::inRandomOrder()->take(4)->get();

        $menus = Menu::with('category')->get();

        return view('customer.menu', compact('categories', 'menus', 'popularMenus'));
    }


    /**
     * Add an item to the cart.
     */
    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // If already in cart, increment quantity
            $cart[$id]['quantity']++;
        } else {
            // Add new item to cart
            $cart[$id] = [
                'name' => $menu->name,
                'image' => $menu->image,
                'price' => $menu->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $menu->name . ' added to cart successfully!');
    }
}

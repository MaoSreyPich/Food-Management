<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // If your Order has relations, replace 'user' with the actual relation name (e.g. 'items', 'orderItems')
        // $orders = Order::with('user')->latest()->paginate(8);

        // Simple safe pagination without invalid relation
        $orders = Order::latest()->paginate(12);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);

        return redirect()->route('admin.orders.index')->with('success', "Order #{$id} marked as {$status}!");
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }
}
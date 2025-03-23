<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Restrict access to cashier or admin roles via routes or constructor
    
    // Cashier: Show form to create a new order
    public function create()
    {
        $foodItems = FoodItem::all();
        return view('cashier.orders.create', compact('foodItems'));
    }

    // Cashier: Store the new order
    public function store(Request $request)
    {
        $request->validate([
            'order_items' => 'required|array',
            'order_items.*.food_item_id' => 'required|exists:food_items,id',
            'order_items.*.size' => 'required|in:default,full,half',
            'order_items.*.quantity' => 'required|integer|min:1',
        ]);

        // Calculate total
        $total = 0;
        foreach ($request->order_items as $item) {
            $foodItem = FoodItem::find($item['food_item_id']);
            $price = $this->getPriceBySize($foodItem, $item['size']);
            $total += ($price * $item['quantity']);
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => Carbon::now()->toDateString(),
            'total_amount' => $total,
        ]);

        // Create order items
        foreach ($request->order_items as $item) {
            $foodItem = FoodItem::find($item['food_item_id']);
            $price = $this->getPriceBySize($foodItem, $item['size']);

            OrderItem::create([
                'order_id' => $order->id,
                'food_item_id' => $foodItem->id,
                'size' => $item['size'],
                'unit_price' => $price,
                'quantity' => $item['quantity'],
                'subtotal' => $price * $item['quantity'],
            ]);
        }

        // Optionally broadcast event for real-time dashboard
        event(new \App\Events\OrderPlaced($order));

        return redirect()->route('order.receipt', $order->id)
            ->with('success', 'Order placed successfully.');
    }

    // Helper function to get price by size
    private function getPriceBySize($foodItem, $size)
    {
        if ($size === 'default') {
            return $foodItem->default_price ?? 0;
        } elseif ($size === 'full') {
            return $foodItem->full_price ?? 0;
        } else {
            return $foodItem->half_price ?? 0;
        }
    }

    // View order receipt
    public function receipt($orderId)
    {
        $order = Order::with('orderItems.foodItem')->findOrFail($orderId);
        return view('cashier.orders.receipt', compact('order'));
    }

    // Admin: Show daily orders / dashboard
    public function index()
    {
        // Example: show today's orders
        $today = Carbon::now()->toDateString();
        $orders = Order::where('order_date', $today)->get();
        return view('admin.orders.index', compact('orders'));
    }
}


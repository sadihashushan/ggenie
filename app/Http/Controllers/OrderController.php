<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;

class OrderController extends Controller
{
    // Get all orders
    public function index(Request $request)
    {
        $user = $request->user(); // Ensure the user is authenticated

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $orders = Order::with('address', 'supermarket')
            ->where('user_id', $user->id)
            ->get();

        return response()->json(['orders' => $orders], 200);
    }


    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'supermarket_id' => 'required|exists:supermarkets,id',
            'order_items' => 'required|array',
            'status' => 'required|in:new,processing,completed,canceled',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'notes' => 'nullable|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'supermarket_id' => $request->supermarket_id,
            'order_items' => $request->order_items,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes,
        ]);

        $address = Address::create([
            'order_id' => $order->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'city' => $request->city,
        ]);

        return response()->json(['order' => $order, 'address' => $address], 201);
    }

    // Show a specific order
    public function show($id)
    {
        $order = Order::with('address', 'supermarket')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

    // Update a specific order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'supermarket_id' => 'sometimes|required|exists:supermarkets,id',
            'order_items' => 'sometimes|required|array',
            'status' => 'sometimes|required|in:new,processing,completed,canceled',
            'payment_method' => 'sometimes|required|string',
            'payment_status' => 'sometimes|required|string',
            'notes' => 'nullable|string',
        ]);

        $order->update([
            'user_id' => $request->user_id ?? $order->user_id,
            'supermarket_id' => $request->supermarket_id ?? $order->supermarket_id,
            'order_items' => $request->order_items ?? $order->order_items,
            'status' => $request->status ?? $order->status,
            'payment_method' => $request->payment_method ?? $order->payment_method,
            'payment_status' => $request->payment_status ?? $order->payment_status,
            'notes' => $request->notes ?? $order->notes,
        ]);

        return response()->json($order, 200);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
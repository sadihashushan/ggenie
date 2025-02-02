<?php

namespace App\Helpers;

use Livewire\Livewire;
use App\Models\Supermarket;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    static public function addItemToCart($supermarket_id, $grocery_list)
    {
        // Get the current cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();

        if (!is_array($cart_items)) {
            $cart_items = [];
        }

        // Fetch the supermarket details (id, name, and images)
        $supermarket = Supermarket::where('id', $supermarket_id)
            ->first(['id', 'name', 'location', 'images']); 

        // Check if supermarket exists
        if ($supermarket) {
            $order_items = explode("\n", $grocery_list);

            $cart_items[] = [
                'supermarket' => [
                    'id' => $supermarket->id,
                    'name' => $supermarket->name,
                    'location' => $supermarket->location,
                    'images' => $supermarket->images,  
                ],
                'order_items' => $order_items,  // Store the raw text of the grocery list
            ];

            // Save the updated cart items back to the cookie
            self::addCartItemsToCookie($cart_items);
        }

        return count($cart_items);
    }

    static public function removeCartItem($supermarket_id)
    {
        // Get current cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();

        // Filter out the cart item that matches the supermarket_id
        $cart_items = array_filter($cart_items, function ($item) use ($supermarket_id) {
            // Check if the supermarket key exists and return true if the item doesn't match the supermarket_id
            return isset($item['supermarket']) && $item['supermarket']['id'] != $supermarket_id;
        });

        // Re-index the array to reset the array keys after filtering
        $cart_items = array_values($cart_items);

        // Update the cookie with the new cart items
        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);

        \Log::info('Cart Items Saved:', $cart_items);
    }

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    static public function getCartItemsFromCookie()
    {
        $cart_items = Cookie::get('cart_items');
        if ($cart_items) {
            $decoded_items = json_decode($cart_items, true); // Decode as associative array
            return is_array($decoded_items) ? $decoded_items : [];
        }
        return [];
    }
}
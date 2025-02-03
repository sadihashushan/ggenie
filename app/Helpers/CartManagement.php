<?php

namespace App\Helpers;

use Livewire\Livewire;
use App\Models\Supermarket;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    static public function addItemToCart($supermarket_id, $grocery_list)
    {
        $cart_items = self::getCartItemsFromCookie();

        if (!is_array($cart_items)) {
            $cart_items = [];
        }

        $supermarket = Supermarket::where('id', $supermarket_id)
            ->first(['id', 'name', 'location', 'images']); 

        if ($supermarket) {
            $order_items = explode("\n", $grocery_list);

            $cart_items[] = [
                'supermarket' => [
                    'id' => $supermarket->id,
                    'name' => $supermarket->name,
                    'location' => $supermarket->location,
                    'images' => $supermarket->images,  
                ],
                'order_items' => $order_items, 
            ];

            self::addCartItemsToCookie($cart_items);
        }

        return count($cart_items);
    }

    static public function removeCartItem($supermarket_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        $cart_items = array_filter($cart_items, function ($item) use ($supermarket_id) {
            return isset($item['supermarket']) && $item['supermarket']['id'] != $supermarket_id;
        });

        $cart_items = array_values($cart_items);

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
            $decoded_items = json_decode($cart_items, true);
            return is_array($decoded_items) ? $decoded_items : [];
        }
        return [];
    }
}
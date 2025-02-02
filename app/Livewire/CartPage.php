<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Livewire\Partials\Navbar;

#[Title('Cart Page - GroceryGenie')]
class CartPage extends Component
{
    public $cart_items = [];

    public $groceryList;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
    }

    public function removeItem($supermarket_id)
    {
        $this->cart_items = CartManagement::removeCartItem($supermarket_id);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}

<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount()
    {
        $cartItems = CartManagement::getCartItemsFromCookie();
        if (is_array($cartItems) || $cartItems instanceof Countable) {
            $this->total_count = count($cartItems);
        } else {
            $this->total_count = 0;
        }
    }

    protected $listeners = ['update-cart-count' => 'updateCartCount'];

    #[On('update-cart-count')]
    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}

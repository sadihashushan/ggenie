<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders - GroceryGenie')]
class OrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(5);
    
        return view('livewire.orders-page', [
            'orders' => $my_orders
        ]);
    }
}

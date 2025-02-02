<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Detail - GroceryGenie')]
class OrderDetailPage extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $address = Address::where('order_id', $this->order_id)->first();
        $order = Order::where('id', $this->order_id)->first();
        return view('livewire.order-detail-page', [
            'address' => $address,
            'order' => $order
        ]);
    }
}

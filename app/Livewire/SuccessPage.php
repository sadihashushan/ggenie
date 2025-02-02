<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Supermarket;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Success - GroceryGenie')]
class SuccessPage extends Component
{
    public $orderIndex;

    public function render()
    {
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        return view('livewire.success-page',[
            'order' => $latest_order,
        ]);
    }
}

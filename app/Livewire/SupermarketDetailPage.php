<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Supermarket;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Supermarket Detail - GroceryGenie')]

class SupermarketDetailPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $groceryList = ''; 

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.supermarket-detail-page', [
            'supermarket' => Supermarket::where('slug', $this->slug)->firstOrFail()
        ]);
    }

    //Add to cart
    public function addToCart()
    {
        $supermarket_id = Supermarket::where('slug', $this->slug)->first()->id;

        $items = $this->groceryList;

        if (!empty($items)) {
            $total_count = CartManagement::addItemToCart($supermarket_id, $items);

            $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

            $this->groceryList = '';

            $this->alert('success', 'List added to cart successfully', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true
            ]);

        } else {
            session()->flash('error', 'Please enter at least one item.');
        }
    }
}

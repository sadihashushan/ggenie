<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Models\Supermarket;
use App\Models\Order;
use App\Models\Address;
use Livewire\Component;

#[Title('Checkout - GroceryGenie')]
class CheckoutPage extends Component
{
    public $orderIndex;

    public $first_name;
    public $last_name;
    public $phone;
    public $city;
    public $street_address;
    public $payment_method;

    public function placeOrder() 
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        if ($this->orderIndex === null || !isset($cart_items[$this->orderIndex])) {
            session()->flash('error', 'Invalid order selected.');
            return;
        }

        $selected_order = $cart_items[$this->orderIndex];

        if (empty($selected_order['supermarket']) || !isset($selected_order['supermarket']['id'])) {
            session()->flash('error', 'The selected supermarket is invalid.');
            return;
        }

        $supermarket_id = $selected_order['supermarket']['id'];
        $supermarket = Supermarket::find($supermarket_id);

        if (!$supermarket) {
            session()->flash('error', 'The selected supermarket does not exist.');
            return;
        }

        if (empty($selected_order['order_items']) || !is_array($selected_order['order_items'])) {
            session()->flash('error', 'The grocery list is empty or invalid.');
            return;
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->supermarket_id = $supermarket_id;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->order_items = implode("\n", $selected_order['order_items']);
        $order->notes = 'Order placed by ' . auth()->user()->name;

        $address = new Address;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->city = $this->city;
        $address->street_address = $this->street_address;

        $redirect_url = '';

        if ($this->payment_method === 'card') {
            $redirect_url = route('success');
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        CartManagement::removeCartItem($supermarket_id);
        Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);

        // Redirect with success message
        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('orders.index');
    }

    public function mount($orderIndex = null)
    {
        $this->orderIndex = $orderIndex;

        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) === 0) {
            return redirect('/supermarkets');
        }
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();

        $selected_order = null;
        if ($this->orderIndex !== null && isset($cart_items[$this->orderIndex])) {
            $selected_order = $cart_items[$this->orderIndex];
        }

        return view('livewire.checkout-page', [
            'selected_order' => $selected_order,
        ]);
    }
}

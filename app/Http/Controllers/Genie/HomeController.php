<?php

namespace App\Http\Controllers\Genie;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if (!Session::has('genie_id')) {
            return redirect()->route('genie.login');
        }

        $genieId = Session::get('genie_id');

        $newOrders = Order::where('status', 'new')->get();
        $ongoingOrders = Order::where('status', 'processing')->where('genie_id', $genieId)->get();
        $completedOrders = Order::where('status', 'completed')->where('genie_id', $genieId)->get();

        return view('genie.home', compact('newOrders', 'ongoingOrders', 'completedOrders'));
    }

    public function newOrders()
    {
        $newOrders = Order::with('address', 'supermarket')->where('status', 'new')->get();
        return response()->json($newOrders, 200);
    }

    public function ongoingOrders()
    {
        $genieId = Session::get('genie_id');
        $ongoingOrders = Order::with('address', 'supermarket')->where('status', 'processing')->where('genie_id', $genieId)->get();
        return response()->json($ongoingOrders, 200);
    }

    public function completedOrders()
    {
        $genieId = Session::get('genie_id');
        $completedOrders = Order::with('address', 'supermarket')->where('status', 'completed')->where('genie_id', $genieId)->get();
        return response()->json($completedOrders, 200);
    }

    public function acceptOrder(Order $order)
    {
        $this->checkSession();
        $order->update([
            'status' => 'processing',
            'payment_status' => 'pending',
            'genie_id' => Session::get('genie_id'),
        ]);

        return redirect()->route('genie.home');
    }

    public function declineOrder(Order $order)
    {
        $this->checkSession();
        $order->update(['status' => 'canceled']);
        return redirect()->route('genie.home');
    }

    public function completeOrder(Order $order)
    {
        $this->checkSession();
        $order->update([
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        return redirect()->route('genie.home');
    }

    public function failOrder(Order $order)
    {
        $this->checkSession();
        $order->update([
            'status' => 'canceled',
            'payment_status' => 'failed',
        ]);

        return redirect()->route('genie.home');
    }

    private function checkSession()
    {
        if (!Session::has('genie_id')) {
            redirect()->route('genie.login')->send();
        }
    }
}

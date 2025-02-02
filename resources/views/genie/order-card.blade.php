<div class="bg-white rounded-lg shadow-md p-6">
    <h5 class="text-xl font-bold text-purple-600">Order #{{ $order->id }}</h5>
    <p class="mt-2"><strong>Items:</strong></p>
    <ul class="list-disc list-inside">
        @if(is_array($order->order_items))
            @foreach($order->order_items as $item)
                <li>{{ $item }}</li>
            @endforeach
        @else
            <li>{{ $order->order_items }}</li>
        @endif
    </ul>    
    <p class="card-text"><strong>Customer:</strong> {{ $order->address->full_name }}</p>
    <p><strong>Address:</strong> {{ $order->address->street_address }}, {{ $order->address->city }}</p>
    <p><strong>Phone:</strong> {{ $order->address->phone }}</p>
    <p class="card-text"><strong>Supermarket:</strong> {{ $order->supermarket->name }}</p>
    <div class="flex space-x-2 mt-4">
        @if(in_array('accept', $actions))
            <form action="{{ route('genie.orders.accept', $order) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accept</button>
            </form>
        @endif
        @if(in_array('decline', $actions))
            <form action="{{ route('genie.orders.decline', $order) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Decline</button>
            </form>
        @endif
        @if(in_array('complete', $actions))
            <form action="{{ route('genie.orders.complete', $order) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Complete</button>
            </form>
        @endif
        @if(in_array('fail', $actions))
            <form action="{{ route('genie.orders.fail', $order) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Fail</button>
            </form>
        @endif
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: auto;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 20px;
        }
        .section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            color: #374151;
        }
        .info p {
            margin: 5px 0;
        }
        .list {
            padding-left: 20px;
        }
        .list li {
            margin-bottom: 5px;
            font-size: 16px;
            color: #374151;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Order Invoice</h1>

        <!-- Customer -->
        <div class="section">
            <h2 class="text-xl font-semibold text-gray-700">Customer Details</h2>
            <p class="text-lg font-semibold text-gray-800">{{$order->address->full_name}}</p>
            <p class="text-sm text-gray-600">{{$order->address->city}}, {{$order->address->street_address}}</p>
            <p class="text-sm text-gray-600">Phone: {{$order->address->phone}}</p>
        </div>

        <!-- Order Details -->
        <div class="section">
            <h2 class="text-xl font-semibold text-gray-700">Order Details</h2>
            <div class="info">
                <p><strong>Order Number:</strong> {{$order->id}}</p>
                <p><strong>Date:</strong> {{$order->created_at->format('d-m-Y')}}</p>
                <p><strong>Payment:</strong> {{$order->payment_method == 'cod' ? 'Cash on Delivery' : 'Card (On Delivery)'}}</p>
            </div>
        </div>

        <!-- Supermarket Details -->
        <div class="section">
            <h2 class="text-xl font-semibold text-gray-700">Supermarket Details</h2>
            <div class="info">
                <p><strong>Name:</strong> {{$order->supermarket->name}}</p>
                <p><strong>Location:</strong> {{$order->supermarket->location}}</p>
            </div>
        </div>

        <!-- Grocery List -->
        <div class="section">
            <h2 class="text-xl font-semibold text-gray-700">Grocery List</h2>
            <ul class="list">
                @foreach(explode("\n", $order->order_items) as $item)
                    <li>{{$item}}</li>
                @endforeach
            </ul>
        </div>

        <p class="footer">Thank you for your purchase!</p>
    </div>
</body>
</html>

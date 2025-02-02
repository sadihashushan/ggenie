<section class="flex items-center font-poppins py-10 bg-gray-50 min-h-screen">
  <div class="justify-center flex-1 max-w-6xl px-4 py-6 mx-auto bg-white border rounded-md shadow-lg md:py-12 md:px-10">
    <div>
      <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700 text-center">
        Thank you. Your order has been received.
      </h1>

      <!-- Customer Info -->
      <div class="flex items-stretch justify-start w-full px-4 mb-8 border-b border-gray-200">
        <div class="flex items-start justify-start">
          <div class="flex flex-col space-y-2">
            <p class="text-lg font-semibold text-gray-800">
              {{$order->address->full_name}}
            </p>
            <p class="text-sm text-gray-600">{{$order->address->city}}</p>
            <p class="text-sm text-gray-600">{{$order->address->street_address}}</p>
            <p class="text-sm text-gray-600">{{$order->address->phone}}</p>
          </div>
        </div>
      </div>

      <!-- Order Details -->
      <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200">
        <div class="w-full px-4 mb-4 md:w-1/3">
          <p class="mb-2 text-sm text-gray-600">Order Number:</p>
          <p class="text-base font-semibold text-gray-800">{{$order->id}}</p>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/3">
          <p class="mb-2 text-sm text-gray-600">Date:</p>
          <p class="text-base font-semibold text-gray-800">{{$order->created_at->format('d-m-Y')}}</p>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/3">
          <p class="mb-2 text-sm text-gray-600">Payment Method:</p>
          <p class="text-base font-semibold text-gray-800">
            {{$order->payment_method == 'cod' ? 'Cash on Delivery' : 'Card (On Delivery)'}}
          </p>
        </div>
      </div>

      <div class="px-4 mb-10">
        <div class="flex flex-col space-y-8">
          <!-- Supermarket Details -->
          <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-700">Supermarket Details</h2>
            <div class="space-y-4">
              <div class="flex justify-between">
                <p class="text-base text-gray-800">Name:</p>
                <p class="text-base text-gray-600">{{$order->supermarket->name}}</p>
              </div>
              <div class="flex justify-between">
                <p class="text-base text-gray-800">Location:</p>
                <p class="text-base text-gray-600">{{$order->supermarket->location}}</p>
              </div>
            </div>
          </div>

          <!-- Grocery List -->
          <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-700">Grocery List</h2>
            <ul class="list-disc pl-6 text-gray-800">
              @foreach(explode("\n", $order->order_items) as $item)
                <li>{{$item}}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-start gap-4 px-4 mt-6">
        <a href="{{ route('invoice.download', $order->id) }}" class="w-full px-4 py-2 text-center text-purple-500 border border-purple-500 rounded-md md:w-auto hover:text-white hover:bg-purple-600">
          Download Invoice
        </a>
        <a href="/supermarkets" class="w-full px-4 py-2 text-center text-purple-500 border border-purple-500 rounded-md md:w-auto hover:text-white hover:bg-purple-600">
          Go Back Shopping
        </a>
        <a href="/orders" class="w-full px-4 py-2 text-center text-white bg-purple-500 rounded-md md:w-auto hover:bg-purple-600">
          View My Orders
        </a>
      </div>
    </div>
  </div>
</section>

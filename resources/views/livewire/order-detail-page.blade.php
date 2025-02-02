<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Order Details</h1>

  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>
        <div>
          <p class="text-xs uppercase tracking-wide text-gray-500">Customer</p>
          <p class="mt-1 text-sm text-gray-800">{{$address->full_name}}</p>
        </div>
      </div>
    </div>

    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 22h14" />
            <path d="M5 2h14" />
            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
          </svg>
        </div>
        <div>
          <p class="text-xs uppercase tracking-wide text-gray-500">Order Date</p>
          <p class="mt-1 text-sm text-gray-800">{{$order->created_at->format('d-m-Y')}}</p>
        </div>
      </div>
    </div>

    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
                  @php
                  $status = '';
                  $payment_status = '';
                  if($order->status == 'new') {
                    $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">New</span>';
                  }
                  if($order->status == 'processing') {
                    $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span>';
                  }
                  if($order->status == 'completed') {
                    $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Completed</span>';
                  }
                  if($order->status == 'canceled') {
                    $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelled</span>';
                  }
                  if($order->payment_status == 'paid') {
                    $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                  }
                  if($order->payment_status == 'pending') {
                    $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pending</span>';
                  }
                  if($order->payment_status == 'failed') {
                    $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Failed</span>';
                  }
                @endphp
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
              {!! $status !!}
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
          </svg>
        </div>
        <div>
          <p class="text-xs uppercase tracking-wide text-gray-500">Payment Status</p>
          <p class="mt-1 text-sm">{!! $payment_status !!}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-col md:flex-row gap-6 mt-8">
    <div class="md:w-3/4 bg-white shadow-md p-6 rounded-lg">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Order Details</h2>
      <table class="w-full text-left">
        <thead>
          <tr>
            <th class="pb-2">Supermarket</th>
            <th class="pb-2">Location</th>
            <th class="pb-2">Items</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$order->supermarket->name}}</td>
            <td>{{$order->supermarket->location}}</td>
            <td>
              <ul class="list-disc pl-5">
                @foreach(explode("\n", $order->order_items) as $item)
                  <li>{{$item}}</li>
                @endforeach
              </ul>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="md:w-1/4 bg-white shadow-md p-6 rounded-lg">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Shipping Address</h2>
      <p class="text-gray-700">{{$order->address->street_address}}, {{$order->address->city}}</p>
      <p class="mt-2 text-gray-700 font-medium">Phone: {{$order->address->phone}}</p>
    </div>
  </div>
</div>

    </div>
    </div>
  </div>
</div>
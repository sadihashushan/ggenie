<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-purple-50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-purple-700">Your Shopping Cart</h1>
      <p class="text-gray-600 text-lg">Review your selected items and proceed to checkout</p>
    </div>
    <div class="flex flex-col gap-6">
      <!-- Cart Items -->
      <div class="bg-white overflow-hidden rounded-lg shadow-lg p-6 mb-6">
        @foreach ($cart_items as $item)
        <div class="relative bg-purple-100 rounded-lg shadow-md mb-6 p-6 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/cart-page.png') }}');"></div>
          <div class="relative z-10">
            <div class="flex justify-between items-center">
              <div>
                <h2 class="text-xl font-semibold text-purple-800">{{ $item['supermarket']['name'] ?? 'Unknown Supermarket' }}</h2>
                <p class="text-sm text-purple-600">{{ $item['supermarket']['location'] ?? 'Unknown Location' }}</p>
              </div>
              <button 
                wire:click="removeItem(@json($item['supermarket']['id'] ?? null))" 
                class="bg-purple-300 text-purple-800 border-2 border-purple-400 rounded-lg px-3 py-1 hover:bg-red-600 hover:text-white">
                <span wire:loading.remove wire:target="removeItem(@json($item['supermarket']['id'] ?? null))">Remove</span>
                <span wire:loading wire:target="removeItem(@json($item['supermarket']['id'] ?? null))">Removing...</span>
              </button>
            </div>
            <div class="mt-4">
              <h3 class="text-lg font-medium text-purple-700">Grocery List:</h3>
              <ul class="list-disc pl-6 text-gray-800">
                @if(is_array($item['order_items']))
                  @foreach ($item['order_items'] as $grocery_item)
                    <li>{{ $grocery_item }}</li>
                  @endforeach
                @else
                  <li>No items available</li>
                @endif
              </ul>
            </div>
            <div class="flex justify-end mt-6">
              <a href="{{ route('checkout', ['orderIndex' => $loop->index]) }}" 
                class="bg-purple-700 text-white py-2 px-4 rounded-lg hover:bg-purple-800">
                Checkout
              </a>
            </div>
          </div>
        </div>
        @endforeach
        @if(empty($cart_items))
          <p class="text-gray-500 text-center">Your cart is empty.</p>
        @endif
      </div>
    </div>
  </div>
</div>

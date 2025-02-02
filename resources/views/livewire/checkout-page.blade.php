<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-purple-50">
    <h1 class="text-3xl font-bold text-purple-600 mb-6 text-center">
        Checkout
    </h1>
    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-12 gap-6">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border-t-4 border-purple-400 h-[calc(100%-1rem)]">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-purple-600 mb-4">Shipping Address</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 mb-2 font-medium" for="first_name">
                                    First Name
                                </label>
                                <input wire:model='first_name' 
                                       class="w-full rounded-lg border-gray-300 py-2 px-3 shadow-sm focus:ring-purple-400 focus:border-purple-400 @error('first_name') border-red-500 @enderror" 
                                       id="first_name" 
                                       type="text">
                                @error('first_name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2 font-medium" for="last_name">
                                    Last Name
                                </label>
                                <input wire:model='last_name' 
                                       class="w-full rounded-lg border-gray-300 py-2 px-3 shadow-sm focus:ring-purple-400 focus:border-purple-400" 
                                       id="last_name" 
                                       type="text">
                                @error('last_name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-600 mb-2 font-medium" for="phone">
                                Phone
                            </label>
                            <input wire:model='phone' 
                                   class="w-full rounded-lg border-gray-300 py-2 px-3 shadow-sm focus:ring-purple-400 focus:border-purple-400" 
                                   id="phone" 
                                   type="text">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-600 mb-2 font-medium" for="address">
                                Address
                            </label>
                            <input wire:model='street_address' 
                                   class="w-full rounded-lg border-gray-300 py-2 px-3 shadow-sm focus:ring-purple-400 focus:border-purple-400" 
                                   id="address" 
                                   type="text">
                            @error('street_address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-600 mb-2 font-medium" for="city">
                                City
                            </label>
                            <input wire:model='city' 
                                   class="w-full rounded-lg border-gray-300 py-2 px-3 shadow-sm focus:ring-purple-400 focus:border-purple-400" 
                                   id="city" 
                                   type="text">
                            @error('city')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-lg font-semibold text-gray-600 mb-4">Select Payment Method</div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='payment_method' 
                                   class="hidden peer" 
                                   id="payment-cash" 
                                   type="radio" 
                                   value="cod" 
                                   required />
                            <label class="inline-flex items-center justify-between w-full p-5 text-purple-600 bg-white-100 border border-purple-300 rounded-lg cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-200 peer-checked:shadow-md hover:bg-purple-50" 
                                   for="payment-cash">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Cash on Delivery</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input wire:model='payment_method' 
                                   class="hidden peer" 
                                   id="payment-card" 
                                   type="radio" 
                                   value="card" 
                                   required />
                            <label class="inline-flex items-center justify-between w-full p-5 text-purple-600 bg-white-100 border border-purple-300 rounded-lg cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-200 peer-checked:shadow-md hover:bg-purple-50" 
                                   for="payment-card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Card Payment (On Delivery)</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                    @error('payment_method')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Side -->
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <img src="{{ asset('images/grocery.jpg') }}" 
                     alt="Grocery Image" 
                     class="rounded-lg shadow-md w-full mb-4 h-[20rem] object-cover">
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border-t-4 border-purple-300">
                    <h2 class="text-2xl font-bold text-purple-600 mb-4">Order Details</h2>
                    @if($selected_order)
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-black-600">{{ $selected_order['supermarket']['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $selected_order['supermarket']['location'] }}</p>
                        </div>
                        <h4 class="text-md font-medium text-black-600 mb-2">Grocery List:</h4>
                        <ul class="list-disc pl-5 text-gray-700">
                            @foreach($selected_order['order_items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <button type="submit" 
                                class="bg-purple-600 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-purple-700">
                            <span wire:loading.remove>Place Order</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    @else
                        <p class="text-gray-500">No order selected for checkout.</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

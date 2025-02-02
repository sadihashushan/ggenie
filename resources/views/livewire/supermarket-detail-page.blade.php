<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="overflow-hidden bg-white py-11 font-poppins">

  @if (session()->has('message'))
        <div class="alert alert-success bg-green-200 text-green-800 p-4 rounded-md mb-4">
          {{ session('message') }}
        </div>
  @endif

  @if (session()->has('error'))
        <div class="alert alert-danger bg-red-200 text-red-800 p-4 rounded-md mb-4">
          {{ session('error') }}
        </div>
  @endif
    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage' , $supermarket->images) }}' }">
          <div class="sticky top-0 z-50 overflow-hidden">
            <div class="relative mb-6 lg:mb-10 lg:h-2/4">
              <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full">
            </div>
            <div class="flex-wrap hidden md:flex"></div>
            <div class="px-6 pb-6 mt-6 border-t border-gray-300">
              <div class="flex flex-wrap items-center mt-6">
                <span class="mr-2"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full px-4 md:w-1/2">
          <div class="lg:pl-20">
            <div class="mb-8">
              <h2 class="max-w-xl mb-6 text-2xl font-bold md:text-4xl">
                {{$supermarket->name}}
              </h2>
              <p class="inline-block mb-6 text-4xl font-bold text-gray-700 ">
                <span>{{$supermarket->location}}</span>
              </p>
              <p class="max-w-md text-gray-700">
                {{$supermarket->description}}
              </p>
            </div>
            
            <!-- Grocery List -->
            <div class="mb-8">
              <label for="grocery-list" class="block text-lg font-semibold text-gray-700">Your Grocery List:</label>
              <textarea id="grocery-list" wire:model.lazy="groceryList" class="mt-2 p-3 w-full h-40 border rounded-md" placeholder="Enter items for your grocery list (one per line)"></textarea>
            </div>
            
            <!-- Add to Cart -->
            <div class="flex flex-wrap items-center gap-4">
              <button wire:click='addToCart ({{ $supermarket->id}})'class="w-full p-4 bg-purple-500 rounded-md lg:w-2/5 text-gray-50 hover:bg-purple-600">
                <span wire:loading.remove> Add to cart</span><span wire:loading>Adding...</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


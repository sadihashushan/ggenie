<div>
  <div class="w-full h-screen bg-gradient-to-r from-purple-100 to-purple-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
        <div>
          <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight">
            Welcome to <span class="text-purple-600">GroceryGenie!</span>
          </h1>
          <p class="mt-3 text-lg text-gray-800">Your magical shopping experience awaits...</p>

          <div class="mt-7 grid gap-3 w-full sm:inline-flex">
            <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-purple-600 text-white hover:bg-purple-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('login') }}">
              Login
            </a>
            <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('register') }}">
              Register
            </a>
          </div>
        </div>

        <div>
          <img src="{{ asset('images/home-banner.jpg') }}" alt="Grocery Genie Banner" class="w-full rounded-lg shadow-lg" />
        </div>
      </div>
    </div>
  </div>

  <!-- Reviews Section -->
  <div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">What Our Customers Say</h2>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
          <img src="{{ asset('images/customer.jpg') }}" alt="Customer 1" class="w-16 h-16 rounded-full mx-auto mb-4">
          <h3 class="text-lg font-bold text-gray-800 text-center">Sarah J.</h3>
          <p class="mt-2 text-sm text-gray-700">"The shopping experience is smooth, and I love the variety of options. Highly recommend GroceryGenie to everyone!"</p>
          <div class="mt-4 flex justify-center">
            <span class="text-yellow-500">
              ★★★★☆
            </span>
          </div>
        </div>

        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
          <img src="{{ asset('images/customer.jpg') }}" alt="Customer 2" class="w-16 h-16 rounded-full mx-auto mb-4">
          <h3 class="text-lg font-bold text-gray-800 text-center">Michael B.</h3>
          <p class="mt-2 text-sm text-gray-700">"Convenient, reliable, and magical! GroceryGenie has made my life so much easier."</p>
          <div class="mt-4 flex justify-center">
            <span class="text-yellow-500">
              ★★★★★
            </span>
          </div>
        </div>

        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
          <img src="{{ asset('images/customer.jpg') }}" alt="Customer 3" class="w-16 h-16 rounded-full mx-auto mb-4">
          <h3 class="text-lg font-bold text-gray-800 text-center">Emily R.</h3>
          <p class="mt-2 text-sm text-gray-700">"Fast delivery and great customer service. Definitely my go-to shopping platform."</p>
          <div class="mt-4 flex justify-center">
            <span class="text-yellow-500">
              ★★★★★
            </span>
          </div>
        </div>

        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
          <img src="{{ asset('images/customer.jpg') }}" alt="Customer 4" class="w-16 h-16 rounded-full mx-auto mb-4">
          <h3 class="text-lg font-bold text-gray-800 text-center">John K.</h3>
          <p class="mt-2 text-sm text-gray-700">"GroceryGenie has revolutionized my grocery shopping. It's magical!"</p>
          <div class="mt-4 flex justify-center">
            <span class="text-yellow-500">
              ★★★★☆
            </span>
          </div>
        </div>
      </div>

      <!-- Add a Review -->
      <div class="mt-8 text-center">
        <a href="/reviews" class="py-3 px-6 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700">
          Add a Review
        </a>
      </div>
    </div>
  </div>
</div>

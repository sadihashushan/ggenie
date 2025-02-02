<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GroceryGenie</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-poppins">

    <!-- Navbar -->
    <header class="flex z-50 sticky top-0 flex-wrap md:justify-between w-full bg-[#D6A9FF] text-sm py-3 md:py-4 shadow-md">
        <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 object-cover">
                    <a class="text-xl font-semibold ml-3" href="/" aria-label="Brand">GroceryGenie</a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-800 hover:text-purple-600">Home</a>
                    <a href="/supermarkets" class="text-gray-800 hover:text-purple-600">Supermarkets</a>
                    <a href="/orders" class="text-gray-800 hover:text-purple-600">Orders</a>
                    @auth
                    <a href="{{ route('logout') }}" class="text-gray-800 hover:text-purple-600 py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-purple-600 text-white hover:bg-purple-700"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Page content wrapper -->
    <div class="flex justify-center items-center min-h-screen pt-20"> 
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg relative">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-purple-600 tracking-wide">Contact Us</h1>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mt-4 p-4 bg-green-500 text-white rounded-md shadow-md">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Contact Form -->
            <form action="{{ route('contact.store') }}" method="POST" class="mt-6">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 outline-none text-gray-800" required>
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 outline-none text-gray-800" required>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Message Field -->
                <div class="mb-4">
                    <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="5" class="mt-1 block w-full px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 outline-none text-gray-800" required></textarea>
                    @error('message')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-2 px-4 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-500 transition duration-200 shadow-md">
                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                </button>
            </form>
        </div>
    </div>

</body>

</html>

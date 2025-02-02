<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genie Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showTab(tabId) {
            document.querySelectorAll('.order-section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(tabId).classList.remove('hidden');
        }
    </script>
</head>
<body class="bg-purple-50">
    @include('genie.navbar')

    <div class="container mx-auto py-8">
        <div class="flex">
            <div class="w-full lg:w-1/4 bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-purple-700 mb-6">Navigation</h2>
                <ul class="space-y-4">
                    <li>
                        <button onclick="showTab('new-orders')" class="block bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-600 w-full text-left">
                            New Orders
                        </button>
                    </li>
                    <li>
                        <button onclick="showTab('ongoing-orders')" class="block bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-600 w-full text-left">
                            Ongoing Orders
                        </button>
                    </li>
                    <li>
                        <button onclick="showTab('completed-orders')" class="block bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-600 w-full text-left">
                            Completed Orders
                        </button>
                    </li>
                </ul>
            </div>

            <div class="w-full lg:w-3/4 lg:ml-6">
                <div id="new-orders" class="order-section">
                    <h1 class="text-3xl font-bold text-purple-700 mb-6">New Orders</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($newOrders as $order)
                            @include('genie.order-card', ['order' => $order, 'actions' => ['accept', 'decline']])
                        @endforeach
                    </div>
                </div>

                <div id="ongoing-orders" class="order-section hidden">
                    <h1 class="text-3xl font-bold text-purple-700 mb-6">Ongoing Orders</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($ongoingOrders as $order)
                            @include('genie.order-card', ['order' => $order, 'actions' => ['complete', 'fail']])
                        @endforeach
                    </div>
                </div>

                <div id="completed-orders" class="order-section hidden">
                    <h1 class="text-3xl font-bold text-purple-700 mb-6">Completed Orders</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($completedOrders as $order)
                            @include('genie.order-card', ['order' => $order, 'actions' => []])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('genie.footer')
</body>
</html>

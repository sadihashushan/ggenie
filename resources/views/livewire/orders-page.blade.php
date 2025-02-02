<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="relative mb-10">
    <img 
      src="{{ asset('images/order-page.png') }}"
      alt="Cart Page Banner" 
      class="w-full h-64 object-cover rounded-lg"
    />
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-transparent to-gray-900 opacity-80 rounded-lg"></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <h1 class="text-4xl font-bold text-white">My Orders</h1>
    </div>
  </div>

  <!-- Orders Table -->
  <div class="flex flex-col bg-white p-5 rounded-lg shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden rounded-lg border border-gray-200">
          <table id="orders-table" class="w-full border-collapse border border-gray-300">
            <thead>
              <tr class="bg-gray-200">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Supermarket</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Orders -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-5 flex justify-between items-center">
      <button id="prevPage" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500" disabled>Previous</button>
      <span id="pageIndicator" class="text-gray-700 text-lg font-medium"></span>
      <button id="nextPage" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500">Next</button>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem("token");

    if (!token) {
        console.error("No token found");
        return;
    }

    let orders = [];
    let currentPage = 1;
    const itemsPerPage = 5;

    const ordersTableBody = document.querySelector("#orders-table tbody");
    const prevPageBtn = document.getElementById("prevPage");
    const nextPageBtn = document.getElementById("nextPage");
    const pageIndicator = document.getElementById("pageIndicator");

    // Fetch orders
    fetch("/api/orders", {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.orders || !Array.isArray(data.orders)) {
            throw new Error("Invalid response format");
        }

        orders = data.orders;
        renderTable();
    })
    .catch(error => console.error("Error fetching orders:", error));

    function renderTable() {
        ordersTableBody.innerHTML = ""; 

        const startIndex = (currentPage - 1) * itemsPerPage;
        const paginatedOrders = orders.slice(startIndex, startIndex + itemsPerPage);

        paginatedOrders.forEach(order => {
            const statusBadge = getStatusBadge(order.status);
            const paymentBadge = getPaymentBadge(order.payment_status);

            const row = `
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">${order.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${new Date(order.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${order.supermarket?.name ?? "N/A"}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${paymentBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="/orders/${order.id}" class="bg-purple-500 text-white py-2 px-4 rounded-md shadow hover:bg-purple-600">View Details</a>
                    </td>
                </tr>
            `;
            ordersTableBody.insertAdjacentHTML("beforeend", row);
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(orders.length / itemsPerPage);
        pageIndicator.innerText = `Page ${currentPage} of ${totalPages}`;

        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
    }

    prevPageBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    nextPageBtn.addEventListener("click", () => {
        const totalPages = Math.ceil(orders.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });

    function getStatusBadge(status) {
        const colors = {
            "new": "bg-blue-500",
            "processing": "bg-yellow-500",
            "completed": "bg-green-500",
            "canceled": "bg-red-500"
        };
        return `<span class="${colors[status] || "bg-gray-500"} py-1 px-3 rounded text-white shadow">${capitalize(status)}</span>`;
    }

    function getPaymentBadge(payment_status) {
        const colors = {
            "paid": "bg-green-500",
            "pending": "bg-blue-500",
            "failed": "bg-red-500"
        };
        return `<span class="${colors[payment_status] || "bg-gray-500"} py-1 px-3 rounded text-white shadow">${capitalize(payment_status)}</span>`;
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
</script>

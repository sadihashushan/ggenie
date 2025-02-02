<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="relative mb-10">
    <img src="{{ asset('images/supermarket-banner.png') }}" alt="Supermarket Banner" class="w-full h-60 object-cover rounded-lg shadow-lg">
    <div class="absolute inset-0 bg-purple-700 bg-opacity-30 flex items-center justify-center">
      <h1 class="text-4xl font-bold text-white shadow-lg">Explore Our Supermarkets</h1>
    </div>
  </div>

  <!-- Search Bar -->
  <div class="mb-6 flex justify-center">
    <input type="text" id="search" placeholder="Search supermarkets..."
           class="w-1/2 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none">
    <button id="searchBtn" class="px-4 py-2 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 transition">
      Search
    </button>
  </div>

  <!-- Supermarkets -->
  <section class="py-10 bg-gray-50 font-poppins rounded-lg">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
      <div class="flex flex-col items-center mb-12">
        <h2 class="text-3xl font-semibold text-purple-700">Supermarkets</h2>
        <p class="text-gray-600 mt-2">Find the best supermarkets near you!</p>
      </div>
      <div id="supermarketsList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
        <!-- Supermarkets -->
      </div>
      <div class="flex justify-center mt-8" id="pagination">
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    fetchSupermarkets(); 

    window.addEventListener('fetchSupermarkets', function () {
      fetchSupermarkets();
    });

    document.getElementById('searchBtn').addEventListener('click', function () {
      fetchSupermarkets(document.getElementById('search').value);
    });

    document.getElementById('filterFavorites').addEventListener('click', function () {
      fetchFavorites();
    });
  });

  function fetchSupermarkets(query = '') {
    fetch('/api/supermarkets')
      .then(response => response.json())
      .then(data => {
        const supermarketsList = document.getElementById("supermarketsList");
        supermarketsList.innerHTML = '';

        let filteredSupermarkets = data;
        if (query) {
          filteredSupermarkets = data.filter(supermarket =>
            supermarket.name.toLowerCase().includes(query.toLowerCase())
          );
        }

        if (filteredSupermarkets.length === 0) {
          supermarketsList.innerHTML = `<p class="text-gray-500 text-center col-span-full">No supermarkets found.</p>`;
          return;
        }

        filteredSupermarkets.forEach(supermarket => {
          supermarketsList.innerHTML += `
            <div class="bg-light-purple rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition duration-300">
              <div class="relative">
                <a href="/supermarkets/${supermarket.slug}">
                  <img src="/storage/${supermarket.images}" alt="${supermarket.name}" class="object-cover w-full aspect-[3/2] rounded-t-lg">
                </a>
                <button class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="toggleFavorite(${supermarket.id})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                  </svg>
                </button>
              </div>
              <div class="p-4 text-center">
                <h3 class="text-xl font-medium text-purple-700 mb-2">${supermarket.name}</h3>
                <p class="text-gray-600 mb-4">
                  <span class="text-green-600 font-semibold">${supermarket.location}</span>
                </p>
                <a href="/supermarkets/${supermarket.slug}" class="inline-block w-40 px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md transition">
                  Visit Store
                </a>
              </div>
            </div>
          `;
        });
      })
      .catch(error => console.error("Error fetching supermarkets:", error));
  }

</script>
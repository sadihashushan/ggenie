<div class="p-6 max-w-lg mx-auto bg-white shadow-md rounded-md my-10">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Submit Your Review</h2>
    <form wire:submit.prevent="submitReview">
               <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name (Optional)</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                placeholder="Enter your name (optional)"
                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            @error('name') 
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Review -->
        <div class="mb-4">
            <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
            <textarea
                id="review"
                wire:model="reviewText"
                rows="4"
                placeholder="Write your review here"
                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            ></textarea>
            @error('reviewText') 
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Rating -->
        <div class="mb-4">
            <label for="star_count" class="block text-sm font-medium text-gray-700">Stars</label>
            <div class="flex space-x-2 text-3xl">
                @foreach(range(1, 5) as $star)
                    <button
                        type="button"
                        wire:click="$set('starCount', {{ $star }})"
                        class="transition-transform transform hover:scale-110 focus:outline-none {{ $star <= $starCount ? 'text-blue-500' : 'text-gray-300' }}"
                    >
                        ★
                    </button>
                @endforeach
            </div>
            @error('starCount') 
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full px-4 py-2 text-white bg-purple-500 rounded-md hover:bg-purple-700 focus:ring focus:ring-purple-300 focus:outline-none"
        >
            Submit Review
        </button>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 text-green-600 bg-green-100 border border-green-300 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>

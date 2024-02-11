<!-- resources/views/driver/rating.blade.php -->
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Rate Driver: {{ $driver->user->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 sm:p-8 text-white">
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Driver Name:</p>
                        <p class="font-semibold">{{ $driver->user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Driver Email:</p>
                        <p class="font-semibold">{{ $driver->user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Vehicle Type:</p>
                        <p class="font-semibold">{{ $driver->vehicle_type }}</p>
                    </div>
                    
                    <!-- Rating Form -->
                    <form action="{{ route('driver.submit-rating', $driver) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-sm text-gray-400">Rating:</label>
                            <select name="rating" id="rating" class="form-select mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:outline-none focus:border-blue-500 focus:bg-gray-800">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-sm text-gray-400">Comment:</label>
                            <textarea name="comment" id="comment" class="form-textarea mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:outline-none focus:border-blue-500 focus:bg-gray-800" rows="3"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Rating</button>
                    </form>
                    
                    <!-- Display Ratings and Comments -->
                    <div class="mt-8">
                        @foreach ($driver->ratings as $rating)
                            <div class="border-b border-gray-700 py-4">
                                <p class="text-gray-400">Rating: {{ $rating->rating }}</p>
                                <p class="text-gray-400">Comment: {{ $rating->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

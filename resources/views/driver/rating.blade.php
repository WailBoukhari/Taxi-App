<!-- resources/views/driver/rating.blade.php -->
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Rate Driver: {{ $driver->user->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <!-- Display Driver Details -->
                    <p>Driver Name: {{ $driver->user->name }}</p>
                    <p>Driver Email: {{ $driver->user->email }}</p>
                    <p>Vehicle Type: {{ $driver->vehicle_type }}</p>
                    
                    <!-- Rating Form -->
                    <form action="{{ route('driver.submit-rating', $driver) }}" method="POST">
                        @csrf
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment"></textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Submit Rating</button>
                    </form>
                             <!-- Display Ratings and Comments -->
                    <div class="mt-4">
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

<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Scheduled Rides
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">

                    <!-- Filtering Options -->
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <label for="location" class="text-white">Location:</label>
                            <input type="text" id="location" name="location" class="bg-gray-700 text-white px-4 py-2 rounded">
                        </div>
                        <div>
                            <label for="vehicle_type" class="text-white">Vehicle Type:</label>
                            <select id="vehicle_type" name="vehicle_type" class="bg-gray-700 text-white px-4 py-2 rounded">
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="Van">Van</option>
                            </select>
                        </div>
                        <div>
                            <label for="ratings" class="text-white">Driver Ratings:</label>
                            <select id="ratings" name="ratings" class="bg-gray-700 text-white px-4 py-2 rounded">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars & Above</option>
                                <option value="3">3 Stars & Above</option>
                                <option value="2">2 Stars & Above</option>
                                <option value="1">1 Star & Above</option>
                            </select>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Apply Filters
                        </button>
                    </div>

                    <!-- Display filtered scheduled rides here -->
                    @foreach ($scheduledRides as $ride)
                        <!-- Check if ride matches filters -->
                        <!-- You may need to implement logic here to check if the ride matches the selected filters -->
                        <div class="text-white">
                            <p>Driver Name: {{ $ride->driver->user->name }}</p>
                            <p>Departure City: {{ $ride->departure_city_name }}</p>
                            <p>Destination City: {{ $ride->destination_city_name }}</p>
                            <p>Vehicle Type: {{ $ride->driver->vehicle_brand }}</p>
                            <p>Available Seats: {{ $ride->seats_available }}</p>
                            @if ($ride->seats_available < 6 && $ride->seats_available > 0)
                                <form action="{{ route('scheduled-rides.confirm-booking', $ride) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        Book Now
                                    </button>
                                </form>
                            @else
                                <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded" disabled>
                                    Unavailable
                                </button>
                            @endif

                            <hr class="my-4 border-gray-700">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

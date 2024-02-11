<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">Scheduled Rides</h2>
    </x-slot>
    <form action="{{ route('scheduled-ride') }}" method="GET" class="mt-4 p-4 bg-gray-900 border-b border-gray-800 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="departurePlace" class="text-white block mb-1">Departure Place:</label>
            <select name="departurePlace" class="form-select w-full">
                <option value="">Select Departure Place</option>
                <!-- Fetch options dynamically from the database -->
                @foreach ($departurePlaces as $place)
                    <option value="{{ $place }}">{{ $place }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="arrivalPlace" class="text-white block mb-1">Arrival Place:</label>
            <select name="arrivalPlace" class="form-select w-full">
                <option value="">Select Arrival Place</option>
                <!-- Fetch options dynamically from the database -->
                @foreach ($arrivalPlaces as $place)
                    <option value="{{ $place }}">{{ $place }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="price" class="text-white block mb-1">Price:</label>
            <input type="number" name="price" class="form-input w-full">
        </div>
        <div class="mb-4">
            <label for="seats" class="text-white block mb-1">Seats:</label>
            <input type="number" name="seats" class="form-input w-full">
        </div>
        <div class="mb-4">
            <label for="rating" class="text-white block mb-1">Driver Rating:</label>
            <select name="rating" class="form-select w-full">
                <option value="">Any Rating</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars & Above</option>
                <option value="3">3 Stars & Above</option>
                <option value="2">2 Stars & Above</option>
                <option value="1">1 Star & Above</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg w-full">Filter</button>
    </form>

    <div class="py-8 sm:py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md">
                <div class="p-6 text-white">
                    <div>
                        @forelse ($filteredRides as $ride)
                            <div class="border-b border-gray-700 mb-4 pb-4">
                               <p class="text-lg font-semibold mb-2">
    <a href="{{ route('driver.rating', ['driver' => $ride->driver->id]) }}">
        Driver Name: {{ $ride->driver->user->name }}
    </a>
</p>
                                <p>Departure Place: {{ $ride->departure_city_name }}</p>
                                <p>Arrival Place: {{ $ride->destination_city_name }}</p>
                                <p>Vehicle Type: {{ $ride->driver->vehicle_brand }}</p>
                                <p>Available Seats: {{ $ride->seats_available }}</p>
<p>Driver Rating: {{ $ride->driver->averageRating() }} Stars</p>
                                @if ($ride->seats_available < 6 && $ride->seats_available > 0)
                                    <form action="{{ route('scheduled-rides.confirm-booking', $ride) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg mt-2">Book Now</button>
                                    </form>
                                @else
                                    <button class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg mt-2" disabled>Unavailable</button>
                                @endif
                            </div>
                        @empty
                            <p>No scheduled rides found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

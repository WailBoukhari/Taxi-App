<x-guest-layout class="bg-gray-900">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">Scheduled Rides</h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Form -->
            <form action="{{ route('scheduled-ride') }}" method="GET" class="bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="departing_city" class="text-white block mb-1">Departure Place:</label>
                        <select name="departing_city"
                            class="form-select w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                            <option value="">Select Departure Place</option>
                            <!-- Fetch options dynamically from the database -->
                            @foreach ($departurePlaces as $place)
                                <option value="{{ $place }}">{{ $place }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="arriving_city" class="text-white block mb-1">Arrival Place:</label>
                        <select name="arriving_city"
                            class="form-select w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                            <option value="">Select Arrival Place</option>
                            <!-- Fetch options dynamically from the database -->
                            @foreach ($arrivalPlaces as $place)
                                <option value="{{ $place }}">{{ $place }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price" class="text-white block mb-1">Price:</label>
                        <input type="number" name="price"
                            class="form-input w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label for="seats" class="text-white block mb-1">Seats:</label>
                        <input type="number" name="seats"
                            class="form-input w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label for="rating" class="text-white block mb-1">Driver Rating:</label>
                        <select name="rating"
                            class="form-select w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                            <option value="">Any Rating</option>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars & Above</option>
                            <option value="3">3 Stars & Above</option>
                            <option value="2">2 Stars & Above</option>
                            <option value="1">1 Star & Above</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg w-full mt-4">Filter</button>
            </form>

            <!-- Ride Listings -->
            <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
                @forelse ($filteredRides as $ride)
                    @if ($ride->driver->availability === 'available')
                        <div class="bg-gray-800 rounded-lg shadow-md p-6 text-white">
                            <div class="flex items-center mb-2">
                                <img src="{{ $ride->driver->profile_picture }}" alt="Driver Profile"
                                    class="w-8 h-8 rounded-full mr-2">
                                <p class="text-lg font-semibold">
                                    <a href="{{ route('driver.rating', ['driver' => $ride->driver->id]) }}"
                                        class="hover:text-blue-400">
                                        {{ $ride->driver->user->name }}
                                    </a>
                                </p>
                            </div>
                            <p>Departure Place: {{ $ride->departure_city_name }}</p>
                            <p>Arrival Place: {{ $ride->destination_city_name }}</p>
                            <p>Vehicle Type: {{ $ride->driver->vehicle_brand }}</p>
                            <p>Available Seats: {{ $ride->seats_available }}</p>
                            <p>Driver Rating: {{ number_format($ride->driver->averageRating(), 1) }} Stars</p>
                            @if ($ride->seats_available > 0)
                                <form action="{{ route('scheduled-rides.confirm-booking', $ride) }}" method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg mt-2">Book
                                        Now</button>
                                </form>
                            @else
                                <button class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg mt-2"
                                    disabled>Unavailable</button>
                            @endif
                        </div>
                    @endif
                @empty
                    <p class="text-white">No scheduled rides found.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-guest-layout>

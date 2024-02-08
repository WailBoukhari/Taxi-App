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

                    <!-- Display filtered scheduled rides here -->
                    @foreach ($scheduledRides as $ride)
                        <div class="text-white">
                            <p>Driver Name: {{ $ride->driver_name }}</p>
                            <p>Departure City: {{ $ride->departure_city_name }}</p>
                            <p>Destination City: {{ $ride->destination_city_name }}</p>
                            <p>Vehicle Type: {{ $ride->vehicle_type }}</p>
                            <p>Available Seats: {{ $ride->seats_available }}</p>
                            @if ($ride->seats_available < 6)
                                <form action="{{ route('scheduled-rides.confirm-booking', $ride) }}" method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
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

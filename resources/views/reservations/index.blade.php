<x-app-layout class="dark">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight dark:text-gray-200">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div id="success-message" class="bg-green-500 text-white px-4 py-3 mb-4 rounded-md shadow-md">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @forelse ($reservations as $reservation)
                <div class="bg-gray-800 shadow-md rounded-md mb-6 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-lg font-semibold text-white">Driver Name:
                                {{ $reservation->driver->user->name }}</p>
                            <p class="text-gray-400">Departure City:
                                {{ $reservation->scheduledRide->departure_city_name }}</p>
                            <p class="text-gray-400">Destination City:
                                {{ $reservation->scheduledRide->destination_city_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Created At: {{ $reservation->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end">
                            @if ($reservation->created_at->addHours(0.1)->isPast())
                                <a href="{{ route('driver.rating', ['driver' => $reservation->driver->id]) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mr-2">Rate
                                    Driver</a>
                                <button class="bg-gray-600 text-gray-400 py-2 px-4 rounded-md cursor-not-allowed"
                                    disabled>Cancel</button>
                            @else
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Cancel</button>
                            @endif
                        </div>
                    </form>
                </div>
            @empty
                <p class="text-gray-400 text-center">No reservations found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

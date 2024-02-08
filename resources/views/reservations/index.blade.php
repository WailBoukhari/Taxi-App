<x-app-layout class="dark">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight dark:text-gray-200">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($reservations as $reservation)
                <div class="bg-gray-800 shadow-sm p-4 mb-4 rounded-md">
                    <p class="text-lg font-semibold text-white">Driver Name: {{ $reservation->driver_name }}</p>
                    <p class="text-gray-400">Departure City: {{ $reservation->departure_city }}</p>
                    <p class="text-gray-400">Destination City: {{ $reservation->destination_city }}</p>
                    <p class="text-gray-400">Created At: {{ $reservation->created_at->diffForHumans() }}</p>
                    @if ($reservation->created_at->addHours(24)->isPast())
                        <button class="bg-gray-600 text-gray-400 py-1 px-4 rounded-md cursor-not-allowed" disabled>Cancel</button>
                    @else
                        <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-md">Cancel</button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<!-- resources/views/scheduled-rides/confirm-booking.blade.php -->

<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Confirm Booking
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <h3 class="text-lg font-semibold">Confirmation Details</h3>
                    <!-- Display confirmation details here -->
                    <p>Driver Name: {{ $ride->driver->user->name }}</p>
                    <p>Departure City: {{ $ride->departure_city_name }}</p>
                    <p>Destination City: {{ $ride->destination_city_name }}</p>
                    <p>Payment Method: {{ $ride->driver->payment_method }}</p>
                    <!-- Add more confirmation details -->

                    <form action="{{ route('scheduled-rides.view-receipt', ['ride' => $ride]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Confirm Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

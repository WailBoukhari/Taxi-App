<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Confirm Booking
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <h3 class="text-xl font-semibold mb-6">Confirmation Details</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Driver Name:</p>
                        <p class="font-semibold">{{ $ride->driver->user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Departure City:</p>
                        <p class="font-semibold">{{ $ride->departure_city_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Destination City:</p>
                        <p class="font-semibold">{{ $ride->destination_city_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Payment Method:</p>
                        <p class="font-semibold">{{ $ride->driver->payment_method }}</p>
                    </div>
                    <form action="{{ route('scheduled-rides.view-receipt', ['ride' => $ride]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                            Confirm Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

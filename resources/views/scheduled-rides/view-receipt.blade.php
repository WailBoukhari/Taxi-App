<!-- resources/views/scheduled-rides/receipt.blade.php -->

<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Booking Receipt
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <h3 class="text-lg font-semibold">Ride Information</h3>
                    <p>Driver Name: {{ $ride->driver_name }}</p>
                    <p>Departure City: {{ $ride->departure_city_name }}</p>
                    <p>Destination City: {{ $ride->destination_city_name }}</p>
                    <!-- Add more ride details here -->

                    <hr class="my-4 border-gray-700">

                    <h3 class="text-lg font-semibold">Barcode</h3>
                    <!-- Display the barcode image -->
                    {{ $barcode }}

                    <!-- Additional receipt details -->

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

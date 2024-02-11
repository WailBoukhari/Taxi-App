<!-- resources/views/scheduled-rides/receipt.blade.php -->

<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Booking Receipt
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 sm:p-8 text-white">
                    <h3 class="text-lg font-semibold mb-6">Ride Information</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Driver Name:</p>
                        <p class="font-semibold">{{ $ride->driver_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Departure City:</p>
                        <p class="font-semibold">{{ $ride->departure_city_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-400">Destination City:</p>
                        <p class="font-semibold">{{ $ride->destination_city_name }}</p>
                    </div>
                    <!-- Add more ride details here -->

                    <hr class="my-8 border-gray-700">

                    <h3 class="text-lg font-semibold mb-6">Barcode</h3>
                    <!-- Display the barcode image -->
                    <div class="flex justify-center">
                        {{ $barcode }}
                    </div>

                    <!-- Additional receipt details -->

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

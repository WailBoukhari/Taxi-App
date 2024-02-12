<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <span class="text-blue-600">Statistics</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 rounded-lg">
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-300">Scheduled Rides</h3>
                        <p class="text-gray-300">Total number of scheduled rides: {{ $totalScheduledRides }}</p>
                        <p class="text-gray-300">Total number of reservations: {{ $totalReservations }}</p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-300">Drivers</h3>
                        <p class="text-gray-300">Total number of drivers: {{ $totalDrivers }}</p>
                        <p class="text-gray-300">Total number of active drivers: {{ $activeDrivers }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-300">Passengers</h3>
                        <p class="text-gray-300">Total number of passengers: {{ $totalPassengers }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <span class="text-blue-400">Statistics</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Scheduled Rides Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-300 mb-4">Scheduled Rides</h3>
                    <p class="text-gray-400">Total number of scheduled rides: <span class="font-semibold text-white">{{ $totalScheduledRides }}</span></p>
                    <p class="text-gray-400">Total number of reservations: <span class="font-semibold text-white">{{ $totalReservations }}</span></p>
                </div>

                <!-- Drivers Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-300 mb-4">Drivers</h3>
                    <p class="text-gray-400">Total number of drivers: <span class="font-semibold text-white">{{ $totalDrivers }}</span></p>
                    <p class="text-gray-400">Total number of active drivers: <span class="font-semibold text-white">{{ $activeDrivers }}</span></p>
                </div>

                <!-- Passengers Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-300 mb-4">Passengers</h3>
                    <p class="text-gray-400">Total number of passengers: <span class="font-semibold text-white">{{ $totalPassengers }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            All Scheduled Rides
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Departure City
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Destination City
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Seats Available
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Driver
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-600">
                            @foreach ($scheduledrides as $scheduledride)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    {{ $scheduledride->departure_city_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    {{ $scheduledride->destination_city_name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    {{ $scheduledride->seats_available }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    {{ $scheduledride->driver->user->name }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
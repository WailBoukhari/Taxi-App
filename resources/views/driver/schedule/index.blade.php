<x-app-layout class="bg-gray-900">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 dark:text-gray-200 leading-tight">
            {{ __('Driver Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 dark:bg-gray-700 border-b border-gray-700 dark:border-gray-600">
                    <!-- Display Schedules -->
                    <table class="min-w-full divide-y divide-gray-700 dark:divide-gray-600">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Departure City
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Destination City
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Vehicle Type
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Seats Available
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Reservations
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                    Action
                                </th>
                                <th class="px-6 py-3"></th> <!-- Empty header for buttons -->
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300 dark:text-gray-100">
                                        {{ $schedule->departure_city_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300 dark:text-gray-100">
                                        {{ $schedule->destination_city_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300 dark:text-gray-100">
                                        {{ $schedule->driver->vehicle_brand }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300 dark:text-gray-100">
                                        {{ $schedule->seats_available }} / 6
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300 dark:text-gray-100">
                                        {{ $schedule->reservations->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <!-- Buttons for Edit and Delete -->
                                        <a href="{{ route('driver.schedule.edit', $schedule) }}"
                                            class="text-indigo-500 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-500 mr-3">Edit</a>
                                        <!-- Action buttons -->
                                        @if ($schedule->trashed())
                                            <form action="{{ route('scheduled-rides.enable', $schedule->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="text-green-500 dark:text-green-400 hover:text-green-700 dark:hover:text-green-500 focus:outline-none focus:text-green-500">
                                                    Restore
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('scheduled-rides.disable', $schedule->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500 focus:outline-none focus:text-red-500">
                                                    Disable
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Button to Create Schedule -->
                    <a href="{{ route('driver.schedule.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Create
                        Schedule</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <!-- Display Schedules -->
               <!-- Display Schedules -->
<table class="min-w-full divide-y divide-gray-200">
    <!-- Table header -->
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Departure City
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Destination City
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Vehicle Type
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Seats Available
            </th>
            <th class="px-6 py-3"></th> <!-- Empty header for buttons -->
        </tr>
    </thead>
    <!-- Table body -->
    <tbody>
        @foreach($schedules as $schedule)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $schedule->departure_city_name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $schedule->destination_city_name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $schedule->vehicle_type }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $schedule->seats_available }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <!-- Buttons for Edit and Delete -->
                    <a href="{{ route('driver.schedules.edit', $schedule) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    <form action="{{ route('driver.schedules.destroy', $schedule) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
                        <a href="{{ route('driver.schedule.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Create Schedule</a>

</table>

                    <!-- Button to Create Schedule -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

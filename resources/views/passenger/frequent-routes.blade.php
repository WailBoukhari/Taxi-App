<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Frequent Routes
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($sortedFrequentRoutes->isEmpty())
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-white">No frequent routes found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($sortedFrequentRoutes as $route)
                        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-700 text-white">
                                <p>{{ $route['departure_city'] }} to {{ $route['destination_city'] }} (Booked
                                    {{ $route['count'] }} times)</p>
                                <p>Driver: {{ $route['driver_name'] }}</p>
                                <p>Created At: {{ $route['created_at'] }}</p>
                            </div>
                            <a href="{{ route('search-frequent-route', ['departure_city' => $route['departure_city'], 'destination_city' => $route['destination_city']]) }}"
                                class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4 text-center">
                                Search Frequent Route
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

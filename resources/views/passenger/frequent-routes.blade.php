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
                <div class="grid grid-cols-1 grid-cols-1 gap-4">
                    @foreach ($sortedFrequentRoutes as $route)
                        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-700 text-white">
                                <p>{{ $route['departure_city'] }} to {{ $route['destination_city'] }} (Booked
                                    {{ $route['count'] }} times)</p>
                                <p>Driver: {{ $route['driver_name'] }}</p>
                                <p>Created At: {{ $route['created_at'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

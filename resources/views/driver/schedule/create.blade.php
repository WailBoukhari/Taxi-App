<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Schedule creation form -->
                    <form action="{{ route('driver.schedules.store') }}" method="POST">
                        @csrf

                        <!-- Departure City input -->
                        <div class="mt-4">
                            <x-input-label for="departure_city_name" :value="__('Departure City')" />
                            <x-text-input id="departure_city_name" class="block mt-1 w-full" type="text" name="departure_city_name" required />
                            <x-input-error :messages="$errors->get('departure_city_name')" class="mt-2" />
                        </div>

                        <!-- Destination City input -->
                        <div class="mt-4">
                            <x-input-label for="destination_city_name" :value="__('Destination City')" />
                            <x-text-input id="destination_city_name" class="block mt-1 w-full" type="text" name="destination_city_name" required />
                            <x-input-error :messages="$errors->get('destination_city_name')" class="mt-2" />
                        </div>

                        <!-- Vehicle Type input -->
                        <div class="mt-4">
                            <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                            <x-text-input id="vehicle_type" class="block mt-1 w-full" type="text" name="vehicle_type" />
                            <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                        </div>

                        <!-- Seats Available input -->
                        <div class="mt-4">
                            <x-input-label for="seats_available" :value="__('Seats Available')" />
                            <x-number-input id="seats_available" class="block mt-1 w-full" type="number" name="seats_available" />
                            <x-input-error :messages="$errors->get('seats_available')" class="mt-2" />
                        </div>

                        <!-- Submit button -->
                        <div class="mt-4">
                            <x-button>
                                {{ __('Create Schedule') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

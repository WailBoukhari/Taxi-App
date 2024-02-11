<!-- resources/views/driver/schedule/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Schedule update form -->
                    <form action="{{ route('driver.schedule.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Departure City Name input -->
                        <div class="mt-4">
                            <x-input-label for="departure_city_name" :value="__('Departure City Name')" />
                            <x-text-input id="departure_city_name" class="block mt-1 w-full" type="text" name="departure_city_name" :value="$schedule->departure_city_name" required />
                            <x-input-error :messages="$errors->get('departure_city_name')" class="mt-2" />
                        </div>

                        <!-- Destination City Name input -->
                        <div class="mt-4">
                            <x-input-label for="destination_city_name" :value="__('Destination City Name')" />
                            <x-text-input id="destination_city_name" class="block mt-1 w-full" type="text" name="destination_city_name" :value="$schedule->destination_city_name" required />
                            <x-input-error :messages="$errors->get('destination_city_name')" class="mt-2" />
                        </div>
                        <!-- Seats Available input -->
                        <div class="mt-4">
                            <x-input-label for="seats_available" :value="__('Seats Available')" />
                            <x-text-input id="seats_available" class="block mt-1 w-full" type="number" name="seats_available" :value="$schedule->seats_available" />
                            <x-input-error :messages="$errors->get('seats_available')" class="mt-2" />
                        </div>

                        <!-- Price input -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="$schedule->price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Submit button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Schedule') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

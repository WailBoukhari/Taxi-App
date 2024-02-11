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
                    <form action="{{ route('driver.schedule.store') }}" method="POST">
                        @csrf

                        <!-- Departure City Name input -->
                        <div class="mt-4">
                            <x-input-label for="departure_city_name" :value="__('Departure City Name')" />
                            <x-text-input id="departure_city_name" class="block mt-1 w-full" type="text"
                                name="departure_city_name" :value="old('departure_city_name')" required />
                            <x-input-error :messages="$errors->get('departure_city_name')" class="mt-2" />
                        </div>

                        <!-- Destination City Name input -->
                        <div class="mt-4">
                            <x-input-label for="destination_city_name" :value="__('Destination City Name')" />
                            <x-text-input id="destination_city_name" class="block mt-1 w-full" type="text"
                                name="destination_city_name" :value="old('destination_city_name')" required />
                            <x-input-error :messages="$errors->get('destination_city_name')" class="mt-2" />
                        </div>
                        <!-- Price input -->

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01"
                                name="price" :value="old('price')" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="seats_available" :value="__('Seats Available')" />
                            <select id="seats_available" name="seats_available"
                                class="block mt-1 w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border-gray-300">
                                <option value="2" @if (old('seats_available') == 1) selected @endif>1</option>
                                <option value="2" @if (old('seats_available') == 2) selected @endif>2</option>

                                <option value="2" @if (old('seats_available') == 3) selected @endif>3</option>

                                <option value="2" @if (old('seats_available') == 4) selected @endif>4</option>

                                <option value="4" @if (old('seats_available') == 5) selected @endif>5</option>
                                <option value="6" @if (old('seats_available') == 6) selected @endif>6</option>
                            </select>
                            <x-input-error :messages="$errors->get('seats_available')" class="mt-2" />
                        </div>

                        <!-- Submit button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create Schedule') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

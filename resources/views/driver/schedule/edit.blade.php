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
                    <form action="{{ route('driver.schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Date input -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-date-input id="date" class="block mt-1 w-full" type="date" name="date" :value="$schedule->date" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Time input -->
                        <div class="mt-4">
                            <x-input-label for="time" :value="__('Time')" />
                            <x-time-input id="time" class="block mt-1 w-full" type="time" name="time" :value="$schedule->time" required />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />
                        </div>

                        <!-- Add more inputs for other schedule attributes as needed -->

                        <!-- Submit button -->
                        <div class="mt-4">
                            <x-button>
                                {{ __('Update Schedule') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

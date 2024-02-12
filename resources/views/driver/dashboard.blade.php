<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg">{{ __("Welcome, you're logged in as a driver!") }}</p>
                    @if (!Auth::user()->driver || !Auth::user()->driver->isActive())
                        <a href="{{ route('driver.complete-account') }}"
                            class="inline-block mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg">
                            Complete Account
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

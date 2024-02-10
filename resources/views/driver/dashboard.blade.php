<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
@if (!Auth::user()->driver || !Auth::user()->driver->isActive())
    <a href="{{ route('driver.complete-account') }}" class="btn btn-primary">Complete Account</a>
@endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

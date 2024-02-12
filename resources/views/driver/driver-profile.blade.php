<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver Profile') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 md:px-8 lg:px-12">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <div class="w-24 h-24 rounded-full overflow-hidden mr-4">
                        <img src="{{ asset($driver->profile_picture) }}" alt="{{ $driver->name }}" class="w-full h-full object-cover" />
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $driver->name }}</h2>
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ $driver->description }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>License Plate:</strong> {{ $driver->license_plate }}</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>Vehicle Brand:</strong> {{ $driver->vehicle_brand }}</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>License Number:</strong> {{ $driver->license_number }}</p>
                        </div>
                        <div>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>Account Status:</strong> {{ $driver->status }}</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>Availability:</strong> {{ $driver->availability }}</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300"><strong>Payment Method:</strong> {{ $driver->payment_method }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-lg text-gray-700 dark:text-gray-300"><strong>Average Rating:</strong> {{ number_format($averageRating, 1) }}</p>
                </div>

                <div class="mt-8">
                    <a href="{{ route('driver.edit-profile') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full inline-block">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

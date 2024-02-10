<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ $driver->name }}</h3>

                    <div class="mb-4">
                        <p><strong>Description:</strong> {{ $driver->description }}</p>
                        <p><strong>License Plate:</strong> {{ $driver->license_plate }}</p>
                        <p><strong>Vehicle Brand:</strong> {{ $driver->vehicle_brand }}</p>
                        <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                        <p><strong>Account Status:</strong> {{ $driver->status }}</p>
                        <p><strong>Availability:</strong> {{ $driver->availability }}</p>
                        <p><strong>Payment Method:</strong> {{ $driver->payment_method }}</p>
                    </div>

                    <a href="{{ route('driver.edit-profile') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

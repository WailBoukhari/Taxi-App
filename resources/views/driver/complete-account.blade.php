<!-- complete-account.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complete Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Complete your account to become an active driver.</p>
                    <form action="{{ route('driver.complete-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Image -->
                        <div class="mt-4">
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            <input id="profile_picture" type="file" class="block mt-1 w-full" name="profile_picture"
                                required />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                name="description" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- License Plate -->
                        <div class="mt-4">
                            <x-input-label for="license_plate" :value="__('License Plate')" />
                            <x-text-input id="license_plate"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="license_plate" :value="old('license_plate')" required />
                            <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                        </div>

                        <!-- License Number -->
                        <div class="mt-4">
                            <x-input-label for="license_number" :value="__('License Number')" />
                            <x-text-input id="license_number"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="license_number" :value="old('license_number')" required />
                            <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                        </div>

                        <!-- Vehicle Brand -->
                        <div class="mt-4">
                            <x-input-label for="vehicle_brand" :value="__('Vehicle Brand')" />
                            <x-text-input id="vehicle_brand"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="vehicle_brand" :value="old('vehicle_brand')" required />
                            <x-input-error :messages="$errors->get('vehicle_brand')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Complete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

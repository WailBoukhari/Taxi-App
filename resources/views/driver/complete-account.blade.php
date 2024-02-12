<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complete Account') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg mb-4">Complete your account to become an active driver.</p>
                    <form action="{{ route('driver.complete-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Image -->
                        <div class="mt-4">
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            <div
                                class="relative border-2 border-gray-300 border-dashed rounded-md py-12 flex flex-col items-center">
                                <div
                                    class="absolute top-0 left-0 right-0 bottom-0 flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600">Drag and drop or click to upload</p>
                                </div>
                                <input id="profile_picture" type="file"
                                    class="opacity-0 absolute top-0 left-0 w-full h-full" name="profile_picture"
                                    required />
                            </div>
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

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">
                                Complete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

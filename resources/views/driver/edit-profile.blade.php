<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('driver.update-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Profile Picture -->
                        <div class="mt-4">
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            <input id="profile_picture" type="file" name="profile_picture"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300" />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                name="description" required>{{ $driver->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- License Plate -->
                        <div class="mt-4">
                            <x-input-label for="license_plate" :value="__('License Plate')" />
                            <x-text-input id="license_plate"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="license_plate" :value="$driver->license_plate" required />
                            <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                        </div>

                        <!-- License Number -->
                        <div class="mt-4">
                            <x-input-label for="license_number" :value="__('License Number')" />
                            <x-text-input id="license_number"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="license_number" :value="$driver->license_number" required />
                            <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                        </div>

                        <!-- Vehicle Brand -->
                        <div class="mt-4">
                            <x-input-label for="vehicle_brand" :value="__('Vehicle Brand')" />
                            <x-text-input id="vehicle_brand"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                type="text" name="vehicle_brand" :value="$driver->vehicle_brand" required />
                            <x-input-error :messages="$errors->get('vehicle_brand')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                name="status" required>
                                <option value="active" {{ $driver->status === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $driver->status === 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Availability -->
                        <div class="mt-4">
                            <x-input-label for="availability" :value="__('Availability')" />
                            <select id="availability"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                name="availability" required>
                                <option value="available" {{ $driver->availability === 'available' ? 'selected' : '' }}>
                                    Available
                                </option>
                                <option value="unavailable"
                                    {{ $driver->availability === 'unavailable' ? 'selected' : '' }}>Unavailable
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-4">
                            <x-input-label for="payment_method" :value="__('Payment Method')" />
                            <select id="payment_method"
                                class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300"
                                name="payment_method" required>
                                <option value="cash" {{ $driver->payment_method === 'cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="card" {{ $driver->payment_method === 'card' ? 'selected' : '' }}>Card
                                </option>
                                <option value="other" {{ $driver->payment_method === 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

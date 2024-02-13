<x-app-layout class="bg-gray-900">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            All Drivers
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-900 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-900 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 bg-gray-900 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @foreach ($drivers as $driver)
                                    <tr class="{{ $driver->trashed() ? 'opacity-50' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $driver->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $driver->user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($driver->trashed())
                                                <form action="{{ route('drivers.enable', $driver->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-green-500 hover:text-green-600 focus:outline-none inline-flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 9l3 3 3-3m0 6l-3-3-3 3"></path>
                                                        </svg>
                                                        Restore
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('drivers.disable', $driver->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-600 focus:outline-none inline-flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Disable
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

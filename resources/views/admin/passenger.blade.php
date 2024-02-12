<x-app-layout class="bg-gray-900">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            All Passengers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 text-gray-300">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-600">
                            @foreach ($passengers as $passenger)
                            <tr class="{{ $passenger->trashed() ? 'text-gray-500' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $passenger->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $passenger->user->email }}
                                </td>
                                <td>
                                    <!-- Action buttons -->
                                    @if ($passenger->trashed())
                                        <form action="{{ route('passengers.enable', $passenger->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-green-500 hover:text-green-600 focus:outline-none focus:text-green-600">
                                                Restore
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('passengers.disable', $passenger->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-600 focus:outline-none focus:text-red-600">
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
</x-app-layout>

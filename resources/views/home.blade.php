<x-guest-layout>
    <div class="bg-gray-900 min-h-screen flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-900 text-white font-bold">Search for a Taxi</div>

                <div class="px-6 py-4 bg-gray-800">
                    <form action="{{ route('search') }}" method="GET">

                        <div class="mb-4">
                            <livewire:city-search />
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

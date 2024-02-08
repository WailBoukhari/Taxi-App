<div class="flex flex-col space-y-4 dark">
    <input wire:model="departureQuery" id="departing_city" name="departing_city"
        class="border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500 bg-gray-800 text-white"
        list="departureCitiesList">
    <datalist id="departureCitiesList">
        @foreach ($departureCities as $departureCity)
            <option value="{{ $departureCity->name }}">
        @endforeach
    </datalist>

    <input wire:model="destinationQuery" id="arriving_city" name="arriving_city"
        class="border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500 bg-gray-800 text-white"
        list="destinationCitiesList">
    <datalist id="destinationCitiesList">
        @foreach ($destinationCities as $destinationCity)
            <option value="{{ $destinationCity->name }}">
        @endforeach
    </datalist>
</div>

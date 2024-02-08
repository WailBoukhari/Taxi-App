<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\ScheduledRide;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ScheduledRideFactory extends Factory
{
    protected $model = ScheduledRide::class;

    public function definition()
    {
        $driver = Driver::factory()->create();

        $departureCity = City::inRandomOrder()->first()->name;
        $destinationCity = City::inRandomOrder()->first()->name;

        return [
            'driver_name' => $driver->name,
            'departure_city_name' => $departureCity,
            'destination_city_name' => $destinationCity,
            'vehicle_type' => $driver->vehicle_type,
            'seats_available' => $this->faker->numberBetween(1, 6),
        ];
    }
}

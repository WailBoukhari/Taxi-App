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
            'driver_id' => $driver->id,
            'departure_city_name' => $departureCity,
            'destination_city_name' => $destinationCity,
            'seats_available' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generate a random price
        ];
    }
}

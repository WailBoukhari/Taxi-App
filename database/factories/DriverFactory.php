<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition()
    {
        $user = User::factory()->create();
        $user->assignRole(Role::findByName('driver'));

        $faker = \Faker\Factory::create();

        // Generate a random vehicle brand
        $vehicleBrand = $faker->randomElement(['Dacia', 'Meridic', 'Pigo']);

        // Generate a random license plate
        $licensePlate = strtoupper($faker->lexify('??####'));

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'vehicle_brand' => $vehicleBrand,
            'license_number' => $licensePlate,
        ];
    }
}
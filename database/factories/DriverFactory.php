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
        $faker = \Faker\Factory::create();

        // Create a user with a predefined password
        $user = User::factory()->create([
            'password' => bcrypt('driver123'), // Set the password to "driver123"
        ]);

        // Assign the "driver" role to the user
        $user->assignRole(Role::findByName('driver'));

        // Generate a random vehicle brand
        $vehicleBrand = $faker->randomElement(['Dacia', 'Meridic', 'Pigo']);

        // Generate a random license plate
        $licensePlate = strtoupper($faker->lexify('??####'));

        return [
            'user_id' => $user->id,
            'vehicle_brand' => $vehicleBrand,
            'license_number' => $faker->numerify('##-###-##'), // Generate a random license number
            'profile_picture' => $faker->imageUrl(),
            'description' => $faker->paragraph,
            'license_plate' => $licensePlate,
            'status' => 'active', // Default status to active
            'availability' => $faker->randomElement(['available', 'unavailable']),
            'payment_method' => $faker->randomElement(['cash', 'card', 'other']),
        ];
    }
}

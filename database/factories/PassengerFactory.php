<?php

namespace Database\Factories;

use App\Models\Passenger;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        // Create a user with a predefined password
        $user = User::factory()->create([
            'password' => bcrypt('passenger123'),
        ]);

        // Assign the "passenger" role to the user
        $user->assignRole('passenger');

        return [
            'user_id' => $user->id,
        ];
    }
}

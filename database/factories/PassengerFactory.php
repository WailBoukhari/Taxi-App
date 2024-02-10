<?php

namespace Database\Factories;

use App\Models\Passenger;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

    public function definition()
    {
        $user = User::factory()->create();
        $user->assignRole('passenger'); 

        return [
            'user_id' => $user->id,
        ];
    }
}

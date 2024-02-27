<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScheduledRide;

class ScheduledRideSeeder extends Seeder
{
    public function run()
    {
        ScheduledRide::factory()->times(50)->create();
    }
}

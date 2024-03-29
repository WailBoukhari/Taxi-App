<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(PassengerSeeder::class);
        $this->call(ScheduledRideSeeder::class);
        
    }
}

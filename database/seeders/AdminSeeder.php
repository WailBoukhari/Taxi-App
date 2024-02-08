<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$rQREJO7I7FzjfOBQB9bblew/cXCE4GNswLWNXBoINkf1TUjQYRnlG', // admin15987463
        ]);
        $admin->assignRole('Admin');
    }
}

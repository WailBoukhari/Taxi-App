<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    
    public function dashboard()
    {
        return view("driver.dashboard");
    }
    public function completeAccount(Request $request)
    {
        // Validate the profile completion data...

        $driver = Auth::user()->driver;
        $driver->fill([
            'profile_picture' => $request->input('profile_picture'),
            'description' => $request->input('description'),
            'license_plate' => $request->input('license_plate'),
            'vehicle_type' => $request->input('vehicle_type'),
            'status' => 'active', // Set status to active upon profile completion
        ]);
        $driver->save();

        // Redirect to dashboard or another page
        return redirect()->route('dashboard');
    }

}

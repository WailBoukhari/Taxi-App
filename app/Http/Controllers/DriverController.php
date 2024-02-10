<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    public function dashboard()
    {
        return view("driver.dashboard");
    }
    public function completeAccountForm()
    {
        $driver = auth()->user();
        return view('driver.complete-account', compact('driver'));
    }

    public function completeAccount(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20',
            'license_number' => 'required|string|max:20',
            'vehicle_brand' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $driver = $user->driver ?: new Driver();

        $driver->description = $request->description;
        $driver->license_plate = $request->license_plate;
        $driver->license_number = $request->license_number;
        $driver->vehicle_brand = $request->vehicle_brand;
        $driver->status = "active";

        // Save the profile picture if provided
        if ($request->hasFile('profile_picture')) {
            $driver->profile_picture = $request->file('profile_picture')->store('profile_images', 'public');
        }

        // Associate the driver record with the user and save it
        $user->driver()->save($driver);

        return redirect()->route('driver.dashboard')->with('success', 'Your account has been successfully updated.');
    }


    public function driverProfile()
    {
        // Get the authenticated user's driver profile
        $driver = Auth::user()->driver;

        // Return the view with driver profile data
        return view('driver.driver-profile', compact('driver'));
    }
    // Method to display edit profile form
    public function editProfileForm()
    {
        // Get the authenticated user's driver profile
        $driver = Auth::user()->driver;

        // Return the view with driver profile data
        return view('driver.edit-profile', compact('driver'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the request data
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming profile picture is an image
            'description' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20',
            'vehicle_brand' => 'required|string|max:255',
            'license_number' => 'required|string|max:20',
            'status' => 'required|in:inactive,active',
            'availability' => 'required|in:available,unavailable',
            'payment_method' => 'required|in:cash,card,other',
        ]);

        // Get the authenticated user's driver profile
        $driver = Auth::user()->driver;

        // If driver profile doesn't exist, create it
        if (!$driver) {
            $driver = new Driver();
            $driver->user_id = auth()->id();
        }

        // Update or create driver profile data
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures'); // Store the profile picture
            $driver->profile_picture = $profilePicturePath;
        }
        $driver->description = $request->description;
        $driver->license_plate = $request->license_plate;
        $driver->vehicle_brand = $request->vehicle_brand;
        $driver->license_number = $request->license_number;
        $driver->status = $request->status;
        $driver->availability = $request->availability;
        $driver->payment_method = $request->payment_method;
        $driver->save();

        // Redirect back with success message
        return redirect()->route('driver.driver-profile')->with('success', 'Profile updated successfully.');
    }

}

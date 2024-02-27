<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Rating;
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

        $imageName = null;

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profile_pictures'), $imageName);
        }
        $driver = $user->driver ?: new Driver();

        $driver->description = $request->description;
        $driver->license_plate = $request->license_plate;
        $driver->license_number = $request->license_number;
        $driver->vehicle_brand = $request->vehicle_brand;
        $driver->profile_picture = 'profile_pictures/' . $imageName;
        $driver->status = "active";

        $user->driver()->save($driver);

        return redirect()->route('driver.dashboard')->with('success', 'Your account has been successfully updated.');
    }





    public function driverProfile()
    {
        // Get the authenticated user's driver profile
        $driver = Auth::user()->driver;
        // Calculate the average rating for the driver
        $averageRating = Rating::where('driver_id', $driver->id)->avg('rating');
        // Return the view with driver profile data
        return view('driver.driver-profile', compact('driver', 'averageRating'));
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

        $imageName = null;

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profile_pictures'), $imageName);
        }

        $driver->description = $request->description;
        $driver->license_plate = $request->license_plate;
        $driver->vehicle_brand = $request->vehicle_brand;
        $driver->license_number = $request->license_number;
        $driver->status = $request->status;
        $driver->availability = $request->availability;
        $driver->profile_picture = 'profile_pictures/' . $imageName;

        $driver->payment_method = $request->payment_method;
        $driver->save();

        // Redirect back with success message
        return redirect()->route('driver.driver-profile')->with('success', 'Profile updated successfully.');
    }
    public function showRatingPage(Driver $driver)
    {
        return view('driver.rating', compact('driver'));
    }

    public function enable($id)
    {
        $driver = Driver::withTrashed()->findOrFail($id);
        $driver->restore();
        return redirect()->back()->with('success', 'Driver enabled successfully');
    }

    public function disable($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return redirect()->back()->with('success', 'Driver disabled successfully');
    }
}

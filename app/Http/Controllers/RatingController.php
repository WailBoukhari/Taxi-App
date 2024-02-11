<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{


    public function submitRating(Request $request, Driver $driver)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the associated passenger
                // Set the passenger_id
        
        // Create a new rating record
        $rating = new Rating();
        $rating->driver_id = $driver->id;
        $rating->passenger_id = auth()->user()->id;
        $rating->rating = $validatedData['rating'];
        $rating->comment = $validatedData['comment'];
        $rating->save();

        return redirect()->route('driver.rating', $driver)->with('success', 'Rating submitted successfully.');
    }
}
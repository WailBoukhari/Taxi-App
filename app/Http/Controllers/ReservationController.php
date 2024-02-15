<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ScheduledRide;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function confirmBooking(Request $request, ScheduledRide $ride)
    {
        // Ensure the user is authenticated
        $passenger = $request->user();

        // Check if the passenger exists
        if (!$passenger) {
            abort(404, 'Passenger not found');
        }

        // Get the driver ID from the scheduled ride
        $driverId = $ride->driver_id;

        // Check if the driver ID is available
        if (!$driverId) {
            abort(404, 'Driver not found');
        }

        // Create a new reservation record
        $reservation = new Reservation();
        $reservation->scheduled_ride_id = $ride->id;
        $reservation->passenger_id = $passenger->id;
        $reservation->driver_id = $driverId;
        $reservation->save();

        // Decrement the available seats
        $ride->decrement('seats_available');

        return view('scheduled-rides.confirm-booking', compact('ride'));
    }



    public function index()
    {
        $user = auth()->user();
        $reservations = Reservation::where('passenger_id', $user->id)->get();

        return view('reservations.index', compact('reservations'));
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        if ($reservation->passenger_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $ride = $reservation->scheduledRide;

        $reservation->delete();
        $ride->increment('seats_available');

        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }
}

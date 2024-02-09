<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ScheduledRide;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function confirmBooking(ScheduledRide $ride)
    {
        // Ensure the user is authenticated
        $passenger = auth()->user();
        // dd($passenger);
        // Check if the passenger exists
        if (!$passenger) {
            abort(404, 'Passenger not found');
        }

        // Create a new reservation record
        Reservation::create([
            'scheduled_ride_id' => $ride->id,
            'passenger_id' => $passenger->id,
            'driver_name' => $ride->driver_name,
            'departure_city' => $ride->departure_city_name,
            'destination_city' => $ride->destination_city_name,
        ]);

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
        // Check if the authenticated user owns the reservation
        if ($reservation->passenger_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Cancel the reservation
        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }
}

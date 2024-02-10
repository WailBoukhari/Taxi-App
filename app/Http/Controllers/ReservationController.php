<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ScheduledRide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Closure;

class ReservationController extends Controller
{
    public function confirmBooking(Request $request, Closure $next,ScheduledRide $ride)
    {
        if ($request->user() && !$request->user()->hasRole('passenger')) {
            abort(403, 'Unauthorized action.');
        }
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

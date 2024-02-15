<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FrequentRoute;
use App\Models\Passenger;
use App\Models\Reservation;
use Illuminate\Http\Request;


class PassengerController extends Controller
{
    public function dashboard()
    {
        return view("passenger.dashboard");
    }
    public function frequentRoutes()
    {
        // Retrieve frequent routes data with latest created_at timestamp
        $reservations = Reservation::join('scheduled_rides', 'reservations.scheduled_ride_id', '=', 'scheduled_rides.id')
            ->select('scheduled_rides.departure_city_name', 'scheduled_rides.destination_city_name')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('scheduled_rides.departure_city_name', 'scheduled_rides.destination_city_name')
            ->get();


        // Sort the frequent routes by count in descending order
        $sortedFrequentRoutes = $reservations->sortByDesc('count');

        // Pass data to the view
        return view('passenger.frequent-routes', compact('sortedFrequentRoutes'));
    }

    public function searchSavedRoute(FrequentRoute $route)
    {
        // Retrieve the details of the saved route
        $departureCity = $route->departure_city;
        $destinationCity = $route->destination_city;

        // Perform a search based on the saved route details
        $scheduledRides = $this->searchScheduledRides($departureCity, $destinationCity);

        // Pass the search results to the view
        return view('scheduled-ride', compact('scheduledRides'));
    }
    public function disable(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        // Redirect back or to any other route as needed
        return redirect()->back()->with('success', 'Passenger disabled successfully.');
    }

    public function enable(Request $request, $id)
    {
        $passenger = Passenger::withTrashed()->findOrFail($id);
        $passenger->restore();

        // Redirect back or to any other route as needed
        return redirect()->back()->with('success', 'Passenger enabled successfully.');
    }
  
}

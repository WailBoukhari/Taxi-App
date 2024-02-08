<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FrequentRoute;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    public function dashboard() {
        return view("passenger.dashboard");
    }

    public function frequentRoutes()
    {
        // Get all reservations and group them by departure and destination cities
        $reservations = Reservation::select('departure_city', 'destination_city', 'driver_name', 'created_at')
            ->groupBy('departure_city', 'destination_city', 'driver_name', 'created_at')
            ->get();

        // Count the number of times each route has been booked
        $frequentRoutes = $reservations->groupBy(function ($item) {
            return $item->departure_city . '-' . $item->destination_city;
        })->map(function ($group) {
            return [
                'departure_city' => $group->first()->departure_city,
                'destination_city' => $group->first()->destination_city,
                'driver_name' => $group->first()->driver_name ?? 'Unknown',
                'created_at' => $group->first()->created_at,
                'count' => $group->count(),
            ];
        });

        // Sort the frequent routes by count in descending order
        $sortedFrequentRoutes = $frequentRoutes->sortByDesc('count');

        return view('passenger.frequent-routes', compact('sortedFrequentRoutes'));
    }

}

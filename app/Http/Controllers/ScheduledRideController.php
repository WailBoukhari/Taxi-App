<?php

namespace App\Http\Controllers;

use App\Models\ScheduledRide;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScheduledRideController extends Controller
{
    public function showSearchResults(Request $request)
    {
        $departureCity = $request->input('departing_city');
        $destinationCity = $request->input('arriving_city');

        $scheduledRides = $this->searchScheduledRides($departureCity, $destinationCity);

        return view('search-results', compact('scheduledRides'));
    }



    public function viewReceipt(Request $request)
    {
        $rideId = $request->input('ride_id');
        $ride = ScheduledRide::find($rideId);

        if (!$ride) {
            abort(404, 'Ride not found');
        }

        $passenger = Auth::user();
        $barcode = $this->generateBarcode($ride, $passenger);

        return view('scheduled-rides.view-receipt', [
            'ride' => $ride,
            'passenger' => $passenger,
            'barcode' => $barcode,
        ]);
    }

    private function searchScheduledRides($departureCity, $destinationCity)
    {
        $query = ScheduledRide::query();

        if ($departureCity) {
            $query->where('departure_city_name', $departureCity);
        }

        if ($destinationCity) {
            $query->where('destination_city_name', $destinationCity);
        }

        return $query->get();
    }

    private function generateBarcode($ride, $passenger)
    {
        $data = [
            'ride_id' => $ride->id,
            'passenger_id' => $passenger->id,
            'driver_name' => $ride->driver_name,
            // Add more ride and passenger details here
        ];

        return QrCode::size(300)->generate(json_encode($data));
    }
}

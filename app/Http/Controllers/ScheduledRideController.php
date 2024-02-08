<?php

namespace App\Http\Controllers;

use App\Models\ScheduledRide;
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

    public function confirmBooking(ScheduledRide $ride)
    {
        return view('scheduled-rides.confirm-booking', compact('ride'));
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

    public function viewReceipt(Request $request)
    {
        $rideId = $request->input('ride_id');
        $ride = ScheduledRide::find($rideId);
        $passenger = Auth::user();

        // Generate barcode using ride and passenger information
        $barcode = $this->generateBarcode($ride, $passenger);

        return view('scheduled-rides.view-receipt', [
            'ride' => $ride,
            'passenger' => $passenger,
            'barcode' => $barcode, // Pass the barcode variable to the view
        ]);
    }

    private function generateBarcode($ride, $passenger)
    {
        // Construct the barcode data in JSON format
        $barcodeData = [
            'ride' => [
                'driver_name' => $ride->driver_name,
                'departure_city' => $ride->departure_city_name,
                'destination_city' => $ride->destination_city_name,
            ],
            'passenger' => [
                'name' => $passenger->name,
                'email' => $passenger->email,
            ],
        ];

        // Convert the data to JSON format
        $jsonBarcodeData = json_encode($barcodeData);

        // Generate barcode using JSON data
        return QrCode::size(300)->generate($jsonBarcodeData);
    }
}
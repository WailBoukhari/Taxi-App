<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Rating;
use App\Models\ScheduledRide;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScheduledRideController extends Controller
{

    public function showSearchResults(Request $request)
    {
        // Retrieve filtering parameters from the request
        $departureCity = $request->input('departing_city');
        $destinationCity = $request->input('arriving_city');
        $price = $request->input('price');
        $seats = $request->input('seats');
        $rating = $request->input('rating');

        // Fetch departure and arrival places for the dropdown
        $departurePlaces = ScheduledRide::pluck('departure_city_name')->unique();
        $arrivalPlaces = ScheduledRide::pluck('destination_city_name')->unique();

        // Start with all scheduled rides
        $filteredRides = ScheduledRide::query();

        // Apply filters if provided
        if ($departureCity) {
            $filteredRides->where('departure_city_name', $departureCity);
        }

        if ($destinationCity) {
            $filteredRides->where('destination_city_name', $destinationCity);
        }

        if ($price) {
            $filteredRides->where('price', '<=', $price);
        }

        if ($seats) {
            $filteredRides->where('seats_available', '>=', $seats);
        }

        if ($rating) {
            // Filter rides by driver rating
            $filteredRides->whereHas('driver', function ($query) use ($rating) {
                $query->whereHas('ratings', function ($subquery) use ($rating) {
                    $subquery->where('rating', '>=', $rating);
                });
            });
        }

        // Get the filtered rides
        $filteredRides = $filteredRides->get();

        // Return the view with the filtered rides and departure places
        return view('scheduled-ride', compact('filteredRides', 'departurePlaces', 'arrivalPlaces'));
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

        if ($departureCity && $destinationCity) {
            // Search for scheduled rides with both departure and destination cities
            $query->where('departure_city_name', $departureCity)
                ->where('destination_city_name', $destinationCity);
        } elseif ($departureCity) {
            // Search for scheduled rides with only departure city
            $query->where('departure_city_name', $departureCity);
        } elseif ($destinationCity) {
            // Search for scheduled rides with only destination city
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
        ];

        return QrCode::size(300)->generate(json_encode($data));
    }
    public function searchFrequentRoute($departureCity, $destinationCity)
    {
        // Perform a search based on the frequent route details
        $scheduledRides = $this->searchScheduledRides($departureCity, $destinationCity);

        // Pass the search results to the view
        return view('scheduled-ride', compact('scheduledRides'));
    }

    public function indexSchedule()
    {
        $driver = Auth::user()->driver;

        // Get both active and trashed schedules
        $schedules = $driver->scheduledRides()->withCount('reservations')->withTrashed()->get();

        return view('driver.schedule.index', compact('schedules'));
    }


    public function createSchedule(Request $request)
    {
        return view('driver.schedule.create');

    }

    public function storeSchedule(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'departure_city_name' => 'required|string|max:255',
            'destination_city_name' => 'required|string|max:255',
            'seats_available' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        // Get the authenticated user
        $user = Auth::user();

        $driver = $user->driver ?: new Driver();
        $driver->save();
        // Create the scheduled ride
        $scheduledRide = new ScheduledRide([
            'departure_city_name' => $validatedData['departure_city_name'],
            'destination_city_name' => $validatedData['destination_city_name'],
            'seats_available' => $validatedData['seats_available'],
            'price' => $validatedData['price'],
        ]);
        // Associate the scheduled ride with the driver and save it
        $driver->scheduledRides()->save($scheduledRide);

        // Redirect back with success message
        return redirect()->route('driver.schedule.index')->with('success', 'Schedule created successfully.');
    }

    public function editSchedule(ScheduledRide $schedule)
    {
        return view('driver.schedule.edit', compact('schedule'));
    }


    public function updateSchedule(Request $request, ScheduledRide $schedule)
    {
        $validatedData = $request->validate([
            'departure_city_name' => 'required|string|max:255',
            'destination_city_name' => 'required|string|max:255',
            'seats_available' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
        ]);

        $schedule->update($validatedData);

        return redirect()->route('driver.schedule.index')->with('success', 'Schedule updated successfully.');
    }
    public function destroySchedule(ScheduledRide $schedule)
    {
        $schedule->delete();


        return redirect()->route('driver.schedule.index')->with('success', 'Schedule deleted successfully.');
    }

    public function disable(Request $request, $id)
    {
        $scheduledRide = ScheduledRide::findOrFail($id);
        $scheduledRide->delete();

        // Redirect back or to any other route as needed
        return redirect()->back()->with('success', 'Scheduled ride disabled successfully.');
    }

    public function enable(Request $request, $id)
    {
        $scheduledRide = ScheduledRide::withTrashed()->findOrFail($id);
        $scheduledRide->restore();

        // Redirect back or to any other route as needed
        return redirect()->back()->with('success', 'Scheduled ride enabled successfully.');
    }


}

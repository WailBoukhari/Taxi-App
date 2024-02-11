<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\ScheduledRide;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScheduledRideController extends Controller
{
    public function showSearchResults(Request $request)
    {
        $departureCity = $request->input('departing_city');
        $destinationCity = $request->input('arriving_city');

        $scheduledRides = $this->searchScheduledRides($departureCity, $destinationCity);

        return view('scheduled-ride', compact('scheduledRides'));
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
        $schedules = Auth::user()->driver->scheduledRides()->withCount('reservations')->get();
        // Pass the schedules to the view
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




}

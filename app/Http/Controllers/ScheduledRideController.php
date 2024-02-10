<?php

namespace App\Http\Controllers;

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
        $schedules = Auth::user()->driver->schedules;
        // Pass the schedules to the view
        return view('driver.schedule.index', compact('schedules'));
    }
    public function createSchedule(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            // Add validation rules for other schedule details
        ]);

        // Create a new schedule instance
        $schedule = new Schedule();
        $schedule->date = $request->date;
        $schedule->time = $request->time;
        // Assign other schedule details from the request

        // Save the schedule to the database
        $schedule->save();

        // Redirect back with success message
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }
    public function editSchedule($id)
    {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);

        // Check if the schedule belongs to the authenticated driver
        if ($schedule->driver_id !== Auth::user()->driver->id) {
            // If not authorized, redirect back with error message
            return redirect()->route('driver.schedules.index')->with('error', 'Unauthorized access.');
        }

        // Pass the schedule to the view
        return view('driver.schedule.edit', compact('schedule'));
    }
    public function updateSchedule(Request $request, $id)
    {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);

        // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            // Add validation rules for other fields
        ]);

        // Update the schedule
        $schedule->update([
            'date' => $request->date,
            'time' => $request->time,
            // Update other fields accordingly
        ]);

        // Redirect back with success message
        return redirect()->route('driver.dashboard')->with('success', 'Schedule updated successfully.');
    }
    public function deleteSchedule($id)
    {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);

        // Delete the schedule
        $schedule->delete();

        // Redirect back with success message
        return redirect()->route('driver.dashboard')->with('success', 'Schedule deleted successfully.');
    }
}

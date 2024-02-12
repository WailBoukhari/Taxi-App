<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\ScheduledRide;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalScheduledRides = ScheduledRide::count();
        $totalReservations = Reservation::count();

        $totalDrivers = Driver::count();
        $activeDrivers = Driver::where('status', 'active')->count();

        $totalPassengers = Passenger::count();
        return view('admin.dashboard', compact('totalScheduledRides', 'totalReservations', 'totalDrivers', 'activeDrivers', 'totalPassengers'));


    }
    public function indexPassenger()
    {
        $passengers = Passenger::withTrashed()->get();
        return view('admin.passenger', compact('passengers'));
    }
    public function indexDriver()
    {
        $drivers = Driver::withTrashed()->get();
      

        return view('admin.drvier', compact('drivers'));
    }
    public function indexScheduledRide()
    {
        $scheduledrides = ScheduledRide::withTrashed()->get();
        return view('admin.schedule', compact('scheduledrides'));
    }


}
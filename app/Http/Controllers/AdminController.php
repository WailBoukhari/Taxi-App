<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\ScheduledRide;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }
    public function indexPassenger()
    {
        $passengers = Passenger::all();
        return view('admin.passenger', compact('passengers'));
    }
    public function indexDriver()
    {
        $drivers = Driver::all();
        return view('admin.drvier', compact('drivers'));
    }
    public function indexScheduledRide()
    {
        $scheduledrides = ScheduledRide::all();
        return view('admin.schedule', compact('scheduledrides'));
    }

 
}
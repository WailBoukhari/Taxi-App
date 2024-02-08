<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function dashboard() {
        return view("passenger.dashboard");
    }
}

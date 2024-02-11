<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['passenger_id', 'driver_id', 'rating', 'comment'];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function scheduledRides()
    {
        return $this->belongsTo(Schedule::class);
    }
}

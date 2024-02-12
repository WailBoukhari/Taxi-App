<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scheduled_ride_id',
        'passenger_id',
        'passenger_name',
        'driver_name',
        'departure_city',
        'destination_city',
    ];
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
    public function scheduledRide()
    {
        return $this->belongsTo(ScheduledRide::class, 'scheduled_ride_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

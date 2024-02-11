<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledRide extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'departure_city_name',
        'destination_city_name',
        'seats_available',
        'price',];

    public function scheduledRides()
    {
        return $this->hasMany(ScheduledRide::class);
    }
        public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}


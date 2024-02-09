<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledRide extends Model
{
    use HasFactory;
    protected $fillable = ['departure_city_name', 'destination_city_name'];

    public function scheduledRides()
    {
        return $this->hasMany(ScheduledRide::class);
    }
}


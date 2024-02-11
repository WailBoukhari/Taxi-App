<?php

namespace App\Models;

use App\Models\ScheduledRide;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license_number',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isActive()
    {
        return $this->status === 'active';
    }
    public function scheduledRides()
    {
        return $this->hasMany(ScheduledRide::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}

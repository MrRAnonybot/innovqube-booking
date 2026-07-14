<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
    ];
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function priceFor($start, $end): float
    {
        $nights = Carbon::parse($start)->diffInDays(Carbon::parse($end));

        return $nights * $this->price_per_night;
    }
}

<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'property_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => BookingStatus::class,
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

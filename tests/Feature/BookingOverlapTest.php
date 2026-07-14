<?php

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;


it('detects an overlapping booking', function(){
    $property = Property::factory()->create();
    $user = User::factory()->create();

    Booking::create([
        'property_id' => $property->id,
        'user_id' => $user->id,
        'start_date' => '2026-07-10',
        'end_date' => '2026-07-15',
        'total_price' => 500,
        'status' => 'pending',
    ]);

    $conflict = Booking::where('property_id', $property->id)
        ->overlapping('2026-07-12', '2026-07-14')
        ->exists();

    expect($conflict)->toBeTrue();

});



it('allows a booking starting the day another ends', function(){
    $property = Property::factory()->create();
    $user = User::factory()->create();

    Booking::create([
        'property_id' => $property->id,
        'user_id'     => $user->id,
        'start_date'  => '2026-07-10',
        'end_date'    => '2026-07-15',
        'total_price' => 500,
        'status'      => 'pending',
    ]);
    $conflict = Booking::where('property_id', $property->id)
        ->overlapping('2026-07-15', '2026-07-18')
        ->exists();

    expect($conflict)->toBeFalse();
});



it('calculates the total price correctly', function(){
    $property = Property::factory()->create(['price_per_night' => 100]);

    expect($property->priceFor('2026-07-10', '2026-07-13'))->toBe(300.0);
});

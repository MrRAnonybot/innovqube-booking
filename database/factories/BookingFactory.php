<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $property = Property::factory()->create();
        $startDate = fake()->dateTimeBetween('+1 day', '+2 months');
        $endDate = (clone $startDate)->modify('+' . fake()->numberBetween(1, 7) . ' days');
        $nights = $startDate->diff($endDate)->days;
        return [
            'property_id' => $property -> id,
            'user_id' => User::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $nights * $property->price_per_night,
            'status' => BookingStatus::Pending,
        ];
    }
}

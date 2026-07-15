<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Booking;
use App\Enums\BookingStatus;

class MyBookings extends Component
{
    public function cancel(int $bookingId): void
    {
        $booking = Booking::findOrFail($bookingId);

        $this->authorize('cancel', $booking);

        $booking->update(['status' => BookingStatus::Cancelled]);
    }
    #[Layout('layouts.app')]
    public function render()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('property')
            ->latest()
            ->get();

        return view('livewire.my-bookings', [
        'bookings' => $bookings,
    ]);
    }
}

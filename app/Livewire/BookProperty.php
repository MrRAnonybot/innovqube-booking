<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Carbon\Carbon;
use App\Enums\BookingStatus;

class BookProperty extends Component
{
    public Property $property;
    public string $startDate = '';
    public string $endDate = '';


    public function mount(Property $property): void
    {
        $this->property = $property;
    }

    #[Computed]
    public function nights(): int
    {
        if (! $this->startDate || ! $this->endDate) {
            return 0;
        }

        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);


        if ($end->lessThanOrEqualTo($start)) {
            return 0;
        }

        return $start->diffInDays($end);
    }

    #[Computed]
    public function totalPrice(): float
    {
        return $this->nights * $this->property->price_per_night;
    }


    public function book()
    {
        $this->validate([
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate'   => ['required', 'date', 'after:startDate'],
        ]);

        $overlaps = $this->property->bookings()
            ->where('status', '!=', BookingStatus::Cancelled)
            ->overlapping($this->startDate, $this->endDate)
            ->exists();

        if ($overlaps) {
            $this->addError('startDate', 'Ce bien est déjà réservé sur cette période.');
            return;
        }

        $this->property->bookings()->create([
            'user_id'     => auth()->id(),
            'start_date'  => $this->startDate,
            'end_date'    => $this->endDate,
            'total_price' => $this->totalPrice,
            'status'      => BookingStatus::Pending,
        ]);

        return redirect()->route('bookings.index');
        //return redirect()->route('properties.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.book-property');
    }
}

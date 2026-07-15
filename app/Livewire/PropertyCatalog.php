<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Property;
use App\Enums\BookingStatus;
use Livewire\Attributes\Layout;

class PropertyCatalog extends Component
{
    use WithPagination;

    public string $search = '';
    public string $startDate = '';
    public string $endDate = '';

    #[Layout('layouts.app')]
    public function render()
    {
        $properties = Property::query()
            ->when($this->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereDoesntHave('bookings', function ($q) {
                    $q->where('status', '!=', BookingStatus::Cancelled)
                        ->overlapping($this->startDate, $this->endDate);
                });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.property-catalog', [
            'properties' => $properties,
        ]);
    }
}

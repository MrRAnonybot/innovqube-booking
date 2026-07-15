<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Mes réservations</h2>

    @forelse ($bookings as $booking)
        <div class="border rounded-lg p-4 mb-4 flex justify-between items-center">
            <div>
                <h3 class="font-semibold">{{ $booking->property->name }}</h3>
                <p class="text-sm text-gray-600">
                    Du {{ $booking->start_date->format('d/m/Y') }}
                    au {{ $booking->end_date->format('d/m/Y') }}
                </p>
                <p class="text-sm">{{ $booking->total_price }} € · {{ $booking->status->value }}</p>
            </div>

            <button wire:click="cancel({{ $booking->id }})"
                    class="bg-red-600 text-white rounded px-3 py-2 hover:bg-red-700">
                Annuler
            </button>
        </div>
    @empty
        <p class="text-gray-500">Vous n'avez aucune réservation.</p>
    @endforelse
</div>

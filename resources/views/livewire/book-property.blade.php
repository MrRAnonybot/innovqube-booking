<div class="max-w-lg mx-auto p-6">
    <h2 class="text-2xl font-bold mb-2">{{ $property->name }}</h2>
    <p class="text-gray-600 mb-6">{{ $property->price_per_night }} € / nuit · {{ $property->capacity }} pers.</p>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Arrivée</label>
            <input type="date" wire:model.live="startDate" class="border rounded px-3 py-2 w-full">
        </div>
        <div>
            <label class="block text-sm font-medium">Départ</label>
            <input type="date" wire:model.live="endDate" class="border rounded px-3 py-2 w-full">
        </div>

        @if ($this->nights > 0)
            <div class="bg-gray-50 border rounded p-4">
                <p>{{ $this->nights }} nuit(s) × {{ $property->price_per_night }} €</p>
                <p class="text-xl font-bold mt-1">Total : {{ $this->totalPrice }} €</p>
            </div>
        @endif

        <button wire:click="book" class="w-full bg-indigo-600 text-white rounded px-3 py-2 hover:bg-indigo-700">
            Confirmer la réservation
        </button>
        @error('startDate') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        @error('endDate')   <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

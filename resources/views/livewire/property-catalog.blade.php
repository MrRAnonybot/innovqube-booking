<div class="max-w-6xl mx-auto p-6">


    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Rechercher un bien..."
            class="border rounded px-3 py-2"
        >
        <input type="date" wire:model.live="startDate" class="border rounded px-3 py-2">
        <input type="date" wire:model.live="endDate"   class="border rounded px-3 py-2">
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($properties as $property)
            <div class="border rounded-lg p-4 shadow-sm">
                <h3 class="font-bold text-lg">{{ $property->name }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($property->description, 80) }}</p>
                <div class="mt-3 flex justify-between items-center">
                    <span class="font-semibold">{{ $property->price_per_night }} € / nuit</span>
                    <span class="text-sm text-gray-500">{{ $property->capacity }} pers.</span>
                </div>
                <a href="{{ route('properties.book', $property) }}"
                   class="mt-3 block text-center bg-indigo-600 text-white rounded px-3 py-2 hover:bg-indigo-700">
                    Réserver
                </a>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500 py-10">
                Aucun bien disponible pour ces critères.
            </p>
        @endforelse
    </div>


    <div class="mt-6">
        {{ $properties->links() }}
    </div>
</div>

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow" x-data="{ show: true }" x-init="window.addEventListener('redirectToList', () => { setTimeout(() => { window.location.href = '/workouts'; }, 1200); })">
    <h2 class="text-2xl font-bold mb-4">Add Workout</h2>
    @if ($success)
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-center">
            Workout created successfully! Redirecting...
        </div>
    @endif
    <form wire:submit.prevent="createWorkout">
        @if ($apiErrors && isset($apiErrors['form']))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ $apiErrors['form'] }}</div>
        @endif
        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2" />
            @error('title') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            @if ($apiErrors && isset($apiErrors['title']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['title'][0] }}</div>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
            @error('description') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            @if ($apiErrors && isset($apiErrors['description']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['description'][0] }}</div>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1">Trainer</label>
            <input type="text" wire:model="trainer" class="w-full border rounded p-2" />
            @error('trainer') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            @if ($apiErrors && isset($apiErrors['trainer']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['trainer'][0] }}</div>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1">Date & Time</label>
            <input type="datetime-local" wire:model="date" class="w-full border rounded p-2" />
            @error('date') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            @if ($apiErrors && isset($apiErrors['date']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['date'][0] }}</div>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1">Slots</label>
            <input type="number" wire:model="slots" class="w-full border rounded p-2" min="1" />
            @error('slots') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            @if ($apiErrors && isset($apiErrors['slots']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['slots'][0] }}</div>
            @endif
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" wire:model="is_active" id="is_active" class="mr-2" />
            <label for="is_active">Active</label>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Workout</button>
        <a href="/workouts" class="ml-4 text-blue-600 underline">Back to Workouts</a>
    </form>
</div>

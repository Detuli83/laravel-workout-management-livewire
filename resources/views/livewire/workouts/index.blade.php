<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">My Workouts</h2>
    <div class="mb-4 flex gap-2">
        <input type="text" wire:model.lazy="search" placeholder="Search by title..." class="border rounded p-2 w-1/2" />
        <input type="text" wire:model.lazy="trainer" placeholder="Filter by trainer..." class="border rounded p-2 w-1/2" />
        <button wire:click="fetchWorkouts" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
        <a href="/workouts/create" class="ml-auto bg-green-600 text-white px-4 py-2 rounded">Add Workout</a>
    </div>
    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Title</th>
                <th class="p-2">Trainer</th>
                <th class="p-2">Date</th>
                <th class="p-2">Slots</th>
                <th class="p-2">Active</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($workouts as $workout)
                <tr>
                    <td class="p-2">{{ $workout['title'] }}</td>
                    <td class="p-2">{{ $workout['trainer'] }}</td>
                    <td class="p-2">{{ $workout['date'] }}</td>
                    <td class="p-2">{{ $workout['slots'] }}</td>
                    <td class="p-2">{{ $workout['is_active'] ? 'Yes' : 'No' }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="/workouts/{{ $workout['id'] }}/edit" class="text-blue-600 underline">Edit</a>
                        <button wire:click="deleteWorkout({{ $workout['id'] }})" class="text-red-600 underline">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-2 text-center text-gray-500">No workouts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

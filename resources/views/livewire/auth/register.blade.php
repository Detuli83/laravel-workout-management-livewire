<div class="max-w-md mx-auto mt-16 p-8 bg-white rounded-xl shadow-lg">
    <h2 class="text-3xl font-extrabold mb-6 text-blue-700 text-center">Create Your Account</h2>
    <form wire:submit.prevent="register" class="space-y-5">
        @if ($apiErrors && isset($apiErrors['form']))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ $apiErrors['form'] }}</div>
        @endif
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Name</label>
            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @if ($apiErrors && isset($apiErrors['name']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['name'][0] }}</div>
            @endif
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @if ($apiErrors && isset($apiErrors['email']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['email'][0] }}</div>
            @endif
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Password</label>
            <input type="password" wire:model="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @if ($apiErrors && isset($apiErrors['password']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['password'][0] }}</div>
            @endif
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @if ($apiErrors && isset($apiErrors['password_confirmation']))
                <div class="text-red-600 text-sm mt-1">{{ $apiErrors['password_confirmation'][0] }}</div>
            @endif
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">Register</button>
        <div class="text-center mt-4">
            <a href="/login" class="text-blue-600 hover:underline">Already have an account? Login</a>
        </div>
    </form>
</div>

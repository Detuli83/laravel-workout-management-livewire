<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form wire:submit.prevent="login">
        @if ($apiErrors && isset($apiErrors['form']))
            <div class="mb-2 text-red-600">{{ is_array($apiErrors['form']) ? $apiErrors['form'][0] : $apiErrors['form'] }}</div>
        @endif
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2" />
            @if ($apiErrors && isset($apiErrors['email']))
                <div class="text-red-600 text-sm">{{ $apiErrors['email'][0] }}</div>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border rounded p-2" />
            @if ($apiErrors && isset($apiErrors['password']))
                <div class="text-red-600 text-sm">{{ $apiErrors['password'][0] }}</div>
            @endif
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
        <a href="/register" class="ml-4 text-blue-600 underline">Don't have an account?</a>
    </form>
</div>

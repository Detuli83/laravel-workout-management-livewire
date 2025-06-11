<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <div class="bg-white rounded-xl shadow-lg p-10 max-w-lg w-full text-center">
        <h1 class="text-4xl font-extrabold text-blue-700 mb-4">Welcome to Workout Manager</h1>
        <p class="text-gray-700 mb-6">Easily manage your gym training sessions, track your workouts, and stay organized. Register or log in to get started!</p>
        <div class="space-x-4">
            @if(!session('api_token'))
                <a href="/register" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition">Register</a>
                <a href="/login" class="inline-block bg-gray-200 hover:bg-gray-300 text-blue-700 font-semibold px-6 py-2 rounded transition">Login</a>
            @else
                <a href="/workouts" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition">Go to Workouts</a>
            @endif
        </div>
    </div>
</div>

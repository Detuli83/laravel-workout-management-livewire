<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workout Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="font-bold text-xl text-blue-700">
                <a href="/">Workout Manager</a>
            </div>
            <div class="space-x-4">
                <a href="/workouts" class="text-gray-700 hover:text-blue-700">Workouts</a>
                <a href="/workouts/create" class="text-gray-700 hover:text-blue-700">Add Workout</a>
                @if(Auth::check())
                    <form id="logout-form" action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-gray-700 hover:text-blue-700">Login</a>
                    <a href="/register" class="text-gray-700 hover:text-blue-700">Register</a>
                @endif
            </div>
        </div>
    </nav>
    <div class="min-h-screen flex flex-col">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>

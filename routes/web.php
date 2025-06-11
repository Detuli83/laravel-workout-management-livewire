<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Welcome;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Workouts\Index as WorkoutsIndex;
use App\Livewire\Workouts\Create as WorkoutsCreate;
use App\Livewire\Workouts\Edit as WorkoutsEdit;

Route::get('/', Welcome::class)->name('welcome');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/logout', Logout::class)->name('logout');
Route::get('/workouts', WorkoutsIndex::class)->name('workouts.index');
Route::get('/workouts/create', WorkoutsCreate::class)->name('workouts.create');
Route::get('/workouts/{id}/edit', WorkoutsEdit::class)->name('workouts.edit');

Route::post('/logout', function () {
    session()->forget('api_token');
    return redirect('/login');
})->name('logout');

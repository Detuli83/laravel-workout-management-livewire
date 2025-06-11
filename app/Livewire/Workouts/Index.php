<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    public $workouts = [];
    public $search = '';
    public $trainer = '';
    public $errors = [];

    public function mount()
    {
        $this->fetchWorkouts();
    }

    public function fetchWorkouts()
    {
        $token = session('api_token');
        if (!$token) {
            return redirect()->route('login');
        }
        $query = [];
        if ($this->search) {
            $query['title'] = $this->search;
        }
        if ($this->trainer) {
            $query['trainer'] = $this->trainer;
        }
        $response = Http::withToken($token)->get(url('/api/workouts'), $query);
        if ($response->successful()) {
            $this->workouts = $response->json('data');
        } else {
            $this->workouts = [];
        }
    }

    public function deleteWorkout($id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)->delete(url("/api/workouts/{$id}"));
        $this->fetchWorkouts();
    }

    public function render()
    {
        return view('livewire.workouts.index');
    }
}

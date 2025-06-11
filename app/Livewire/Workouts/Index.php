<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class Index extends Component
{
    public $workouts = [];
    public $search = '';
    public $trainer = '';
    public $errors = [];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $this->fetchWorkouts();
    }

    public function fetchWorkouts()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $query = Workout::where('user_id', Auth::id());
        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }
        if ($this->trainer) {
            $query->where('trainer', 'like', '%'.$this->trainer.'%');
        }
        $this->workouts = $query->get();
    }

    public function deleteWorkout($id)
    {
        $workout = Workout::where('id', $id)->where('user_id', Auth::id())->first();
        if ($workout) {
            $workout->delete();
        }
        $this->fetchWorkouts();
    }

    public function render()
    {
        return view('livewire.workouts.index');
    }
}

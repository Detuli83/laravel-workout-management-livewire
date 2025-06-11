<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class Edit extends Component
{
    public $workoutId;
    public $title = '';
    public $description = '';
    public $trainer = '';
    public $date = '';
    public $slots = '';
    public $is_active = true;
    public $apiErrors = [];
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'trainer' => 'required|string|max:255',
        'date' => 'required|date',
        'slots' => 'required|integer|min:1',
        'is_active' => 'boolean',
    ];
    public $success = false;

    public function mount($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $this->workoutId = $id;
        $workout = Workout::where('id', $id)->where('user_id', Auth::id())->first();
        if ($workout) {
            $this->title = $workout->title;
            $this->description = $workout->description;
            $this->trainer = $workout->trainer;
            $this->date = $workout->date;
            $this->slots = $workout->slots;
            $this->is_active = (bool) $workout->is_active;
        }
    }

    public function updateWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $this->success = false;

        $validated = $this->validate();

        try {
            $workout = Workout::where('id', $this->workoutId)->where('user_id', Auth::id())->first();
            if ($workout) {
                $workout->update($validated);
                $this->success = true;
                $this->dispatch('redirectToList');
            } else {
                $this->addError('form', 'Workout not found or unauthorized.');
            }
        } catch (\Exception $e) {
            $this->addError('form', 'Server error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.workouts.edit')->layout('components.layouts.app');
    }
}

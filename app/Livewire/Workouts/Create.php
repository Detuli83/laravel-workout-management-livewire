<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class Create extends Component
{
    public $title = '';
    public $description = '';
    public $trainer = '';
    public $date = '';
    public $slots = '';
    public $is_active = true;
    public $apiErrors = [];
    public $success = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'trainer' => 'required|string|max:255',
        'date' => 'required|date',
        'slots' => 'required|integer|min:1',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }

    public function createWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $this->success = false;

        $validated = $this->validate();

        try {
            $workout = Workout::create(array_merge($validated, [
                'user_id' => Auth::id(),
            ]));
            $this->success = true;
            $this->reset(['title', 'description', 'trainer', 'date', 'slots', 'is_active']);
            $this->dispatch('redirectToList');
        } catch (\Exception $e) {
            $this->addError('form', 'Server error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.workouts.create')->layout('components.layouts.app');
    }
}

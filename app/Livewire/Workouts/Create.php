<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

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
        if (!session('api_token')) {
            return redirect()->route('login');
        }
    }

    public function createWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $this->success = false;

        $validated = $this->validate();

        $token = session('api_token');
        try {
            $response = Http::withToken($token)->post(url('/api/workouts'), $validated);
            if ($response->successful()) {
                $this->success = true;
                $this->reset(['title', 'description', 'trainer', 'date', 'slots', 'is_active']);
                $this->dispatch('redirectToList');
                return;
            } elseif ($response->status() === 422) {
                $this->apiErrors = $response->json('errors');
            } else {
                $this->addError('form', 'Failed to add workout.');
            }
        } catch (\Exception $e) {
            $this->addError('form', 'Server error.');
        }
    }

    public function render()
    {
        return view('livewire.workouts.create')->layout('components.layouts.app');
    }
}

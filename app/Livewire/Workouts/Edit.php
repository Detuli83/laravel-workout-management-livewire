<?php

namespace App\Livewire\Workouts;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadeRequest;

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
        if (!session('api_token')) {
            return redirect()->route('login');
        }
        $this->workoutId = $id;
        $token = session('api_token');
        $response = Http::withToken($token)->get(url("/api/workouts/{$id}"));
        if ($response->successful()) {
            $data = $response->json('data');
            $this->title = $data['title'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->trainer = $data['trainer'] ?? '';
            $this->date = $data['date'] ?? '';
            $this->slots = $data['slots'] ?? '';
            $this->is_active = (bool) ($data['is_active'] ?? true);
        }
    }

    public function updateWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $this->success = false;

        $validated = $this->validate();

        $token = session('api_token');
        try {
            $response = Http::withToken($token)->put(url("/api/workouts/{$this->workoutId}"), $validated);
            if ($response->successful()) {
                $this->success = true;
                $this->dispatch('redirectToList');
                return;
            } elseif ($response->status() === 422) {
                $this->apiErrors = $response->json('errors');
            } else {
                $this->addError('form', 'Failed to update workout.');
            }
        } catch (\Exception $e) {
            $this->addError('form', 'Server error.');
        }
    }

    public function render()
    {
        return view('livewire.workouts.edit')->layout('components.layouts.app');
    }
}

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

    public function mount($id)
    {
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
            $this->is_active = $data['is_active'] ?? true;
        }
    }

    public function updateWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->put(url("/api/workouts/{$this->workoutId}"), [
                'title' => $this->title,
                'description' => $this->description,
                'trainer' => $this->trainer,
                'date' => $this->date,
                'slots' => $this->slots,
                'is_active' => $this->is_active,
            ]);
            if ($response->successful()) {
                return redirect()->route('workouts.index');
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

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

    public function createWorkout()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->post(url('/api/workouts'), [
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

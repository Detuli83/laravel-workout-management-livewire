<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $apiErrors = [];

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.auth');
    }

    public function register()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        // Validate input
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        try {
            Log::info('Livewire direct register attempt', ['email' => $this->email]);
            $user = \App\Models\User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            Log::info('Livewire register success', ['id' => $user->id]);
            Auth::login($user);
            return redirect()->route('workouts.index');
        } catch (\Exception $e) {
            Log::error('Livewire register error', ['error' => $e->getMessage()]);
            $this->addError('form', 'Registration failed: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $apiErrors = [];

    public function login()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        // Validate input
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            Log::info('Livewire direct login attempt', ['email' => $this->email]);
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                session()->regenerate();
                Log::info('Livewire login success', ['email' => $this->email]);
                return redirect()->route('workouts.index');
            } else {
                Log::warning('Livewire login failed', ['email' => $this->email]);
                $this->addError('form', 'Invalid credentials.');
            }
        } catch (\Exception $e) {
            Log::error('Livewire login error', ['error' => $e->getMessage()]);
            $this->addError('form', 'Server error.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}

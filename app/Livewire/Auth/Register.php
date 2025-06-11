<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

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
        try {
            $response = Http::post(url('/api/register'), [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ]);
            if ($response->successful()) {
                session(['api_token' => $response['access_token']]);
                return redirect()->route('workouts.index');
            } elseif ($response->status() === 422) {
                $this->apiErrors = $response->json('errors');
            } else {
                $this->addError('form', 'Registration failed.');
            }
        } catch (\Exception $e) {
            $this->addError('form', 'Server error.');
        }
    }
}

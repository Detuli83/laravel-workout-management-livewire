<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $apiErrors = [];

    public function login()
    {
        $this->resetErrorBag();
        $this->apiErrors = [];
        try {
            $response = Http::post(url('/api/login'), [
                'email' => $this->email,
                'password' => $this->password,
            ]);
            if ($response->successful()) {
                session(['api_token' => $response['access_token']]);
                return redirect()->route('workouts.index');
            } elseif ($response->status() === 422 || $response->status() === 401) {
                $this->apiErrors = $response->json('errors') ?? ['form' => [$response->json('message')]];
            } else {
                $this->addError('form', 'Login failed.');
            }
        } catch (\Exception $e) {
            $this->addError('form', 'Server error.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}

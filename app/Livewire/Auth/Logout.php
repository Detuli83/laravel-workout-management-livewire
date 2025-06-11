<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Logout extends Component
{
    public function logout()
    {
        $token = session('api_token');
        if ($token) {
            Http::withToken($token)->post(url('/api/logout'));
        }
        session()->forget('api_token');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.logout')->layout('components.layouts.auth');
    }
}

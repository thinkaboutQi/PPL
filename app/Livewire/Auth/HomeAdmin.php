<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class HomeAdmin extends Component
{
    public function render()
    {
        return view('livewire.auth.homeadmin')->extends('layouts.app')->section('content');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

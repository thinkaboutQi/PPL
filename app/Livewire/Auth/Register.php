<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function registerUser()
    {
        $this->validate();

        // Tentukan role berdasarkan email
        $role = ($this->email === 'admin@example.com') ? 'admin' : 'user';

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $role,
        ]);


        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}

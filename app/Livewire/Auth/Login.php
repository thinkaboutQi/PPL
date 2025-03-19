<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class Login extends Component
{
    public $identifier, $password, $remember = false;

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.app')->section('content');
    }

    public function rules()
    {
        return [
            'identifier' => ['required'], // Bisa email atau nama lengkap
            'password' => ['required'],
        ];
    }

    public function loginUser()
    {
        $this->resetErrorBag();
        $this->validate();

        $throttleKey = strtolower($this->identifier) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->addError('identifier', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));
            return null;
        }

        // Cek apakah identifier adalah email atau nama lengkap
        $fieldType = filter_var($this->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!Auth::attempt([$fieldType => $this->identifier, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($throttleKey);
            $this->addError('identifier', __('auth.failed'));
            return null;
        }

        RateLimiter::clear($throttleKey);

        return Auth::user()->role === 'admin'
            ? redirect()->to('/admin/dashboard')
            : redirect()->to('/home');
    }
}

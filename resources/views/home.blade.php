@extends('layouts.appuser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body.dark-mode {
        background-color: #121212;
        color: #ffffff;
    }

    .card {
        background-color: #ffffff;
        color: #000000;
    }

    body.dark-mode .card {
        background-color: #1e1e1e;
        color: #ffffff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;

        // Load dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            body.classList.add('dark-mode');
        }

        // Add event listener for dark mode toggle
        document.getElementById('darkModeBtn').addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', body.classList.contains('dark-mode'));
        });
    });
</script>
@endsection

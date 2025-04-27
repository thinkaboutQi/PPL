@extends('layouts.appuser')

@section('content')
<div class="py-5" style="background-color: #1E388D; min-height: 100vh;">
    <div class="container">
        <h1 class="mb-4 text-white" style="font-family: 'Poppins', sans-serif;">Edit Profile</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-5 rounded shadow">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn" style="background-color: #1E388D; color: white;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection

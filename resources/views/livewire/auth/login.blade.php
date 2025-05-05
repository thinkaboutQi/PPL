<div class="d-flex flex-column justify-content-center align-items-center vh-100" style="background-color: #f9f9f9;">
    <!-- Judul SIBESI di atas box login -->
    <h1 class="mb-4" style="font-weight: bold; color: #1D3C91;">SIBESI</h1>

    <!-- Box login -->
    <div style="background-color: #1D3C91; padding: 40px; border-radius: 10px; width: 100%; max-width: 400px;">
        <h2 class="text-white text-center mb-4" style="font-weight: bold;">Login</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="loginUser">
            <div class="mb-3">
                <input type="text" 
                       class="form-control @error('identifier') is-invalid @enderror" 
                       placeholder="Email" 
                       wire:model.defer="identifier">
                @error('identifier')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Password" 
                       wire:model.defer="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-light w-100" style="font-weight: bold; color: #1D3C91;">Login</button>
        </form>

        <div class="text-white text-center mt-3">
            Tidak punya account? 
            <a href="{{ route('register') }}" class="text-white fw-bold" style="text-decoration: underline;">Daftar Akun</a>
        </div>

        <hr class="bg-white my-4">
    </div>
</div>

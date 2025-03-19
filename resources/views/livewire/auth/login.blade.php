<div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">

                    <!-- Notifikasi -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="loginUser">
                        <div class="mb-3">
                            <label for="identifier" class="form-label">Email atau Nama Lengkap</label>
                            <input type="text" class="form-control @error('identifier') is-invalid @enderror" id="identifier" placeholder="Masukkan email atau nama lengkap" wire:model.defer="identifier">
                            @error('identifier')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="********" wire:model.defer="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" wire:model.defer="remember">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>

                        <a href="{{ route('register') }}" class="text-primary">Belum Punya Akun?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

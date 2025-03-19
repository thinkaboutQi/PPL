<div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form wire:submit.prevent="registerUser">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Katarinabluu" wire:model.defer="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="name@example.com" wire:model.defer="email">
                            @error('email')
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
                            <label for="password_confirmation" class="form-label">Ulangi Kata Sandi</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="********" wire:model.defer="password_confirmation">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>

                        <a href="{{ route('login') }}" class="text-primary">Sudah Punya Akun?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

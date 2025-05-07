<div class="d-flex flex-column align-items-center" style="background-color: #f8f9fa; height: 100vh;">
    <h1 class="mt-5" style="color: #1a237e; font-weight: bold;">SIBESI</h1>
    <div class="card mt-3" style="width: 400px; background-color: #1a237e; border-radius: 15px;">
        <div class="card-body">
            <h2 class="text-center mb-4" style="color: #ffffff; font-weight: bold;">sign-up</h2>
            <form wire:submit.prevent="registerUser">
                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" wire:model.defer="email" style="border-radius: 10px;">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama" wire:model.defer="name" style="border-radius: 10px;">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" wire:model.defer="password" style="border-radius: 10px;">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="retype Password" wire:model.defer="password_confirmation" style="border-radius: 10px;">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-light" style="border-radius: 10px; font-weight: bold;">signup</button>
                </div>
            </form>
        </div>
    </div>
</div>

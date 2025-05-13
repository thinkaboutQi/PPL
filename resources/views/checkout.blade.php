@extends('layouts.appuser')

@section('content')
<div style="background-color: #1E388D; min-height: 100vh; padding-top: 0px; padding-bottom: 0px;">
    <div class="container py-5">
        <h2 class="mb-4 text-white" style="font-family: 'Poppins', sans-serif;">Checkout</h2>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Alamat Pengiriman -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Alamat Pengiriman</h5>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', session('order.nama')) }}">
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label>No. Telp</label>
                                <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp', session('order.telp')) }}">
                                @error('telp') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Catatan Pesanan</label>
                                <textarea name="catatan_pesanan" class="form-control">{{ old('catatan_pesanan', session('order.catatan_pesanan')) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', session('order.pin_alamat')) }}">
                                @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', session('order.kode_pos')) }}">
                                @error('kode_pos') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Pin Alamat</label>
                                <textarea name="pin_alamat" class="form-control" readonly>{{ session('order.alamat') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk dan Total -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            @if(session('order.items'))
                                @foreach(session('order.items') as $index => $item)
                                    <div class="mb-3">
                                        <div>{{ $item['product']->nama_produk }}</div>
                                        <img src="{{ asset($item['product']->gambar) }}" alt="{{ $item['product']->nama_produk }}" class="img-fluid mb-2" style="max-height: 100px;">
                                        <div>{{ $item['product']->nama }} ({{ $item['quantity'] }})</div>
                                        <div>Harga: Rp {{ number_format($item['product']->harga * $item['quantity'], 0, ',', '.') }}</div>
                                        
                                        <!-- Kirim hidden input untuk produk -->
                                        <input type="hidden" name="products[{{ $index }}][id]" value="{{ $item['product']->id }}">
                                        <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada produk.</p>
                            @endif

                            <hr>
                            <div class="text-start">
                                <p><strong>Pengiriman:</strong> Free</p>
                                <p><strong>Total:</strong> 
                                    Rp {{ number_format(collect(session('order.items'))->sum(function($item) { 
                                        return $item['product']->harga * $item['quantity']; 
                                    }), 0, ',', '.') }}
                                </p>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

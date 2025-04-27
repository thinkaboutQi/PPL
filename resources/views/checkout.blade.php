@extends('layouts.appuser')

@section('content')
<div style="background-color: #1E388D; min-height: 100vh; padding-top: 50px; padding-bottom: 50px;">
    <div class="container py-5">
        <h2 class="mb-4 text-white" style="font-family: 'Poppins', sans-serif;">Create Order</h2>
        <div class="row">
            <!-- Form Alamat Pengiriman -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Alamat Pengiriman</h5>
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', session('order.nama')) }}">
                            </div>
                            <div class="mb-3">
                                <label>No. Telp</label>
                                <input type="text" name="telp" class="form-control" value="{{ old('telp', session('order.telp')) }}">
                            </div>
                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" name="pin_alamat" class="form-control" value="{{ old('pin_alamat', session('order.pin_alamat')) }}">
                            </div>
                            <div class="mb-3">
                                <label>Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', session('order.kode_pos')) }}">
                            </div>
                            <div class="mb-3">
                                <label>Pin Alamat</label>
                                <textarea name="Pin Alamat" class="form-control">{{ old('pin_alamat', session('order.alamat')) }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Alamat</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body text-center">
                        @if(session('order.items'))
                            @foreach(session('order.items') as $item)
                                <div class="mb-3">
                                    <div>{{ $item['product']->nama_produk }}</div>
                                    <img src="{{ asset($item['product']->gambar) }}" alt="{{ $item['product']->nama_produk }}" class="img-fluid mb-2" style="max-height: 100px;">
                                    <div>{{ $item['product']->nama }} ({{ $item['quantity'] }})</div>
                                    <div>Harga: Rp {{ number_format($item['product']->harga * $item['quantity'], 0, ',', '.') }}</div>
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

                        <a href="{{ route('checkout.confirm') }}" class="btn btn-primary w-100">Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

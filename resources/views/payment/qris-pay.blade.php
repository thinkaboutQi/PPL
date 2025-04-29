@extends('layouts.app')

@section('content')
<div style="background-color: #1E388D; min-height: 100vh; padding-bottom: 50px;">
    <div class="container py-5">
        <h1 class="mb-4 mt-0 text-white" style="font-family: 'Poppins', sans-serif;">Pembayaran QRIS</h1>

        <div class="bg-white p-5 rounded shadow">
            <div class="row">
                <!-- Kiri: QRIS -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 rounded shadow">
                        <h4 class="mb-4" style="font-family: 'Poppins', sans-serif;">Scan QRIS</h4>
                        <div class="text-center">
                            <p>Scan QR Code berikut untuk pembayaran:</p>
                            <img src="{{ asset('images/qris_sibesi.png') }}" alt="QRIS Code" class="img-fluid my-3" style="max-width: 250px;">
                            <h5 class="mt-4" style="font-family: 'Poppins', sans-serif;">Jumlah: 
                                <strong>Rp {{ number_format(session('order.total_amount'), 0, ',', '.') }}</strong>
                            </h5>

                            @if(session('order.status') === 'confirmed')
                                <div class="alert alert-success mt-4">
                                    Pembayaran Berhasil!
                                </div>
                            @else
                                @if(session('order.id'))
                                <form action="{{ route('order.confirm', session('order.id')) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="btn w-100" style="background-color: #1E388D; color: white;">
                                        Konfirmasi Pembayaran
                                    </button>
                                </form>
                                @else
                                <div class="alert alert-danger mt-4">
                                    ID order tidak ditemukan, silakan coba lagi.
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kanan: Invoice (Desain Baru) -->
                <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
                    <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                        <img src="{{ asset('images/icon-success order.png') }}" alt="Success Icon" class="img-fluid mb-4" style="max-width: 150px;">
                        
                        <h3 class="mb-3" style="font-family: 'Poppins', sans-serif; color: #1E388D;">Detail Order Kamu :</h3>

                        @if(session('order.items'))
                        <div class="text-start mt-4">
                            @foreach(session('order.items') as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <div>{{ $item['product']->nama_produk }} x{{ $item['quantity'] }}</div>
                                    <div>Rp {{ number_format($item['product']->harga * $item['quantity'], 0, ',', '.') }}</div>
                                </div>
                            @endforeach

                            <hr>

                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>Rp {{ number_format(session('order.total_amount'), 0, ',', '.') }}</strong>
                            </div>

                            <div class="mt-3">
                                <span class="badge {{ session('order.status') === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ session('order.status') === 'confirmed' ? 'Pembayaran Berhasil' : 'Menunggu Persetujuan Admin' }}
                                </span>
                            </div>
                        </div>
                        @else
                            <p>Tidak ada data produk.</p>
                        @endif

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">Back to home</a>
                            <a href="{{ route('order.history') }}" class="btn btn-primary">History Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end bg-white -->
    </div> <!-- end container -->
</div> <!-- end bg -->
@endsection

@extends('layouts.appuser')

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
                                <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                            </h5>

                            @if($order->status === 'confirmed')
                                <div class="alert alert-success mt-4">
                                    Pembayaran Berhasil!
                                </div>
                            @else
                                <form action="{{ route('order.confirm', $order->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="btn w-100" style="background-color: #1E388D; color: white;">
                                        Konfirmasi Pembayaran
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kanan: Invoice -->
                <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
                    <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                        <img src="{{ asset('images/icon-success order.png') }}" alt="Success Icon" class="img-fluid mb-4" style="max-width: 150px;">
                        
                        <h3 class="mb-3" style="font-family: 'Poppins', sans-serif; color: #1E388D;">Detail Order Kamu :</h3>

                        @if($order->items && $order->items->count() > 0)
                        <div class="text-start mt-4">
                            @foreach($order->items as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <div>{{ $item->ProdukAir->nama_produk }} x{{ $item->quantity }}</div>
                                    <div>Rp {{ number_format($item->ProdukAir->harga * $item->quantity, 0, ',', '.') }}</div>
                                </div>
                            @endforeach

                            <hr>

                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                            </div>

                            <div class="mt-3">
                                <span class="badge {{ $order->status === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $order->status === 'confirmed' ? 'Pembayaran Berhasil' : 'Menunggu Persetujuan Admin' }}
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

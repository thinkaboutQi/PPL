@extends('layouts.appuser')

@section('content')
<div class="container py-5" style="background-color: #0B1C54; color: white;">
    <h2 class="mb-4">Create Order</h2>

    <div class="row">
        <!-- Alamat Pengiriman -->
        <div class="col-md-8">
            <div class="card mb-4" style="background-color: white; color: black; padding: 20px; border-radius: 10px;">
                <h5>Alamat Pengiriman</h5>
                <p><strong>Nama:</strong> {{ $order['alamat']['nama'] ?? '-' }}</p>
                <p><strong>No. Telp:</strong> {{ $order['alamat']['no_telp'] ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $order['alamat']['alamat'] ?? '-' }}</p>
                <p><strong>Kode Pos:</strong> {{ $order['alamat']['kode_pos'] ?? '-' }}</p>
                <p><strong>Pin:</strong> {{ $order['alamat']['pin'] ?? '-' }}</p>
            </div>
        </div>

        <!-- Produk Pesanan -->
        <div class="col-md-4">
            <div class="card" style="background-color: white; color: black; padding: 20px; border-radius: 10px;">
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/galon.png') }}" alt="Galon Air" style="width: 100px;">
                    <h5>Galon Air Bersih</h5>
                </div>

                @php
                    $total = 0;
                @endphp

                @if(isset($order['items']))
                    @foreach($order['items'] as $item)
                        <p>{{ $item['product']->nama_produk }} ({{ $item['quantity'] }} pcs)</p>
                        <p>Harga: Rp {{ number_format($item['product']->harga * $item['quantity'], 0, ',', '.') }}</p>
                        @php
                            $total += $item['product']->harga * $item['quantity'];
                        @endphp
                    @endforeach
                @else
                    <p>Tidak ada produk.</p>
                @endif

                <hr>
                <p><strong>Pengiriman:</strong> Free</p>
                <p><strong>Total:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>

                <form action="{{ route('checkout.confirm') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 mt-3">Konfirmasi Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

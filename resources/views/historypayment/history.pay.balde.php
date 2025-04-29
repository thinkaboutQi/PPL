@extends('layouts.appuser')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-family: 'Poppins', sans-serif;">Riwayat Order</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki riwayat order.
        </div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <span><strong>Order #{{ $order->id }}</strong></span>
                    <span class="badge {{ $order->status === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ $order->status === 'confirmed' ? 'Pembayaran Berhasil' : 'Menunggu Konfirmasi' }}
                    </span>
                </div>
                <div class="card-body">
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between">
                            <div>{{ $item->product->nama_produk }} x{{ $item->quantity }}</div>
                            <div>Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</div>
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

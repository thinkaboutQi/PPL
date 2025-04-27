@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Kiri: QRIS -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Pembayaran QRIS</h4>
                </div>
                <div class="card-body text-center">
                    <p>Scan QR Code berikut untuk pembayaran:</p>
                    <img src="{{ asset('images/qris_sibesi.png') }}" alt="QRIS Code" class="img-fluid mb-3" style="max-width: 250px;">
                    
                    <h5 class="mt-4">Jumlah: <strong>Rp {{ number_format(session('order.total_amount'), 0, ',', '.') }}</strong></h5>

                    @if(session('order.status') === 'confirmed')
                        <div class="alert alert-success mt-3">
                            Pembayaran Berhasil!
                        </div>
                    @else
                        @if(session('order.id'))
                        <form action="{{ route('order.confirm', session('order.id')) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block mt-3">Konfirmasi Pembayaran</button>
                        </form>
                        @else
                        <div class="alert alert-danger mt-3">
                            ID order tidak ditemukan, silakan coba lagi.
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Kanan: Invoice -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Invoice Pemesanan</h4>
                </div>
                <div class="card-body">
                    @if(session('order.items'))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('order.items') as $item)
                                <tr>
                                    <td>{{ $item['product']->nama_produk }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>Rp {{ number_format($item['product']->harga, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['product']->harga * $item['quantity'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <p><strong>Total:</strong> Rp {{ number_format(session('order.total_amount'), 0, ',', '.') }}</p>
                            <p><strong>Status:</strong> 
                                @if(session('order.status') === 'confirmed')
                                    <span class="badge bg-success">Pembayaran Berhasil</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                @endif
                            </p>
                        </div>
                    @else
                        <p>Tidak ada data produk.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

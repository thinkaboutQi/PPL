@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran QRIS</h3>
                </div>
                <div class="card-body">
                    <h4>Terima kasih telah melakukan pemesanan!</h4>
                    <p>Untuk melanjutkan pembayaran, silakan scan QR code di bawah ini menggunakan aplikasi pembayaran yang mendukung QRIS.</p>
                    <div class="text-center">
                        <!-- QR Code Image -->
                        <img src="{{ asset('images/qris_code.png') }}" alt="QRIS Code" class="img-fluid" style="max-width: 250px;">
                    </div>
                    <p class="mt-3">Jumlah yang harus dibayar: <strong>{{ number_format($order->total_amount, 2) }} IDR</strong></p>
                    <p>Jika pembayaran sudah berhasil, klik tombol di bawah untuk mengonfirmasi.</p>
                    <form action="{{ route('order.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

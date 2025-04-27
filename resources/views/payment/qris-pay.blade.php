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
                        <img src="{{ asset('images/qris_sibesi.png') }}" alt="QRIS Code" class="img-fluid" style="max-width: 250px;">
                    </div>

                    <p class="mt-3">Jumlah yang harus dibayar: <strong>{{ number_format(session('order.total_amount'), 2) }} IDR</strong></p>
                    <p>Jika pembayaran sudah berhasil, klik tombol di bawah untuk mengonfirmasi.</p>

                    @if(session('order.id')) <!-- Cek jika order ID ada -->
                        <form action="{{ route('order.confirm', session('order.id')) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Konfirmasi Pembayaran</button>
                        </form>
                    @else
                        <p>ID order tidak ditemukan, silakan coba lagi.</p> <!-- Pesan error jika ID order tidak ditemukan -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

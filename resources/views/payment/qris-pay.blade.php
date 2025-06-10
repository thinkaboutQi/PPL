@extends('layouts.appuser')

@section('content')
<div style="background-color: #1E388D; min-height: 100vh; padding-bottom: 50px;">
    <div class="container py-5">
        <h1 class="mb-4 mt-0 text-white" style="font-family: 'Poppins', sans-serif;">Order Sukses!</h1>
        <div class="row justify-content-center">
            <!-- Kolom QRIS -->
            <div class="col-md-5 mb-4 d-flex align-items-center justify-content-center">
                <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                    <img id="qrisImage" src="{{ asset('images/qris_sibesi.png') }}" alt="QRIS" class="img-fluid mb-4" style="max-width: 250px;">
                    <h5 class="mb-3" style="color: #1E388D;">Scan QRIS untuk Pembayaran</h5>
                    <p class="mb-0" style="color: #555;">Silakan scan kode QR di atas menggunakan aplikasi pembayaran favorit Anda.</p>

                    <!-- Buttons side by side -->
                    <div class="d-flex justify-content-between mt-4">
                        <button id="whatsappChatBtn" class="btn btn-success" style="flex: 1; margin-right: 5px;">chat dengan whatsapp</button>
                        <button id="downloadQrisBtn" class="btn btn-primary" style="flex: 1; margin: 0 5px;">download qris</button>
                        <button id="refreshPaymentBtn" class="btn btn-warning" style="flex: 1; margin-left: 5px;">refresh pembayaran</button>
                    </div>
                </div>
            </div>
            <!-- Kolom Invoice -->
            <div class="col-md-5 mb-4 d-flex align-items-center justify-content-center">
                <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                    <img src="{{ asset('images/icon-success order.png') }}" alt="Success Icon" class="img-fluid mb-4" style="max-width: 150px;">
                    
                    <h3 class="mb-3" style="font-family: 'Poppins', sans-serif; color: #1E388D;">Detail Pesanan :</h3>

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
                            <strong>Total :</strong>
                            <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                        </div>

                        <!-- Additional order details below total -->
                        <div class="mt-3">
                            <p><strong>Nama:</strong> {{ $order->nama ?? 'N/A' }}</p>
                            <p><strong>No. Telp:</strong> {{ $order->no_telp ?? 'N/A' }}</p>
                            <p><strong>Catatan Pesanan:</strong> {{ $order->catatan_pesanan ?? 'N/A' }}</p>
                            <p><strong>Alamat Gedung:</strong> {{ $order->alamat_gedung ?? 'N/A' }}</p>
                            <p><strong>Kode Pos:</strong> {{ $order->kode_pos ?? 'N/A' }}</p>
                            <p><strong>Pin Alamat:</strong> {{ $order->pin_alamat ?? 'N/A' }}</p>
                        </div>

                        <div class="mt-3">
                            <span class="badge {{ $order->status === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $order->status === 'confirmed' ? 'Pembayaran Berhasil' : 'Pesanan sedang disiapkan' }}
                            </span>
                        </div>
                    </div>
                    @else
                        <p>Tidak ada data produk.</p>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn" style="background-color: #1E388D; color: #fff; border: none;">Back to home</a>
                        <a href="{{ route('history') }}" class="btn" style="background-color: #1E388D; color: #fff; border: none;">History Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> <!-- end bg -->

<script>
    document.getElementById('whatsappChatBtn').addEventListener('click', function() {
        // Prepare WhatsApp message with order details
        let message = `Detail Pesanan:%0A`;
        message += `Nama: {{ $order->nama ?? 'N/A' }}%0A`;
        message += `No. Telp: {{ $order->no_telp ?? 'N/A' }}%0A`;
        message += `Catatan Pesanan: {{ $order->catatan_pesanan ?? 'N/A' }}%0A`;
        message += `Alamat Gedung: {{ $order->alamat_gedung ?? 'N/A' }}%0A`;
        message += `Kode Pos: {{ $order->kode_pos ?? 'N/A' }}%0A`;
        message += `Pin Alamat: {{ $order->pin_alamat ?? 'N/A' }}%0A`;
        message += `%0ADetail order ada di aplikasi.`;

        // WhatsApp URL with prefilled message (send to user's phone number)
        let phone = '{{ $order->no_telp ?? "" }}';
        if (!phone) {
            alert('Nomor telepon tidak tersedia.');
            return;
        }
        let whatsappUrl = `https://wa.me/627776719079?text=${message}`;
        window.open(whatsappUrl, '_blank');
    });

    document.getElementById('downloadQrisBtn').addEventListener('click', function() {
        // Download the QRIS image
        const image = document.getElementById('qrisImage');
        const imageUrl = image.src;
        const link = document.createElement('a');
        link.href = imageUrl;
        link.download = 'qris.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    document.getElementById('refreshPaymentBtn').addEventListener('click', function() {
        // Refresh the page to refresh payment status
        location.reload();
    });
</script>
@endsection

@extends('layouts.appuser')

@section('content')
<div style="background-color: #1E388D; min-height: 100vh; padding-bottom: 50px;">
    <div class="container py-5">
        <h1 class="mb-4 mt-0 text-white" style="font-family: 'Poppins', sans-serif;">Bayar Pesanan Kamu!</h1>
        <div class="row justify-content-center">
            <!-- Kolom QRIS -->
            <div class="col-md-5 mb-4 d-flex align-items-center justify-content-center">
                <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                    <img id="qrisImage" src="{{ asset('images/qris_sibesi.png') }}" alt="QRIS" class="img-fluid mb-4" style="max-width: 250px;">
                    <h5 class="mb-3" style="color: #1E388D;">Scan QRIS untuk Pembayaran</h5>
                    <p class="mb-0" style="color: #555;">Silakan scan kode QR di atas menggunakan aplikasi pembayaran favorit Anda.</p>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button id="whatsappChatBtn" class="btn btn-success" style="flex: 1; margin-right: 5px;">Chat WhatsApp</button>
                        <button id="downloadQrisBtn" class="btn btn-primary" style="flex: 1; margin: 0 5px;">Download QRIS</button>
                        <button id="refreshPaymentBtn" class="btn btn-warning" style="flex: 1; margin-left: 5px;">Refresh Pembayaran</button>
                    </div>
                </div>
            </div>

            <!-- Kolom Invoice -->
            <div class="col-md-5 mb-4 d-flex align-items-center justify-content-center">
                <div class="text-center bg-white p-5 rounded shadow" style="max-width: 400px; width: 100%;">
                    <img src="{{ asset('images/icon-success order.png') }}" alt="Success Icon" class="img-fluid mb-4" style="max-width: 150px;">
                    
                    <h3 class="mb-3" style="font-family: 'Poppins', sans-serif; color: #1E388D;">Detail Pesanan:</h3>

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

                        <!-- Detail tambahan -->
                        <div class="mt-3">
                            <p><strong>Nama             :</strong> {{ $order->nama ?? '-' }}</p>
                            <p><strong>No. Telp         :</strong> {{ $order->telp ?? '-' }}</p>
                            <p><strong>Catatan Pesanan  :</strong> {{ $order->catatan_pesanan ?? '-' }}</p>
                            <p><strong>Alamat Gedung    :</strong> {{ $order->alamat ?? '-' }}</p>
                            <p><strong>Kode Pos         :</strong> {{ $order->kode_pos ?? '-' }}</p>
                            <p><strong>Pin Alamat       :</strong> {{ $order->pin_alamat ?? '-' }}</p>
                        </div>

                        <div class="mt-3">
                            <span id="orderStatusBadge" class="badge {{ $order->status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $order->status === 'paid' ? 'Pembayaran Berhasil' : 'Pesanan sedang disiapkan' }}
                            </span>
                        </div>
                    </div>
                    @else
                        <p>Tidak ada data produk.</p>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn" style="background-color: #1E388D; color: #fff; border: none;">Back to Home</a>
                        <a href="{{ route('history') }}" class="btn" style="background-color: #1E388D; color: #fff; border: none;">History Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ganti posisi popup alert QRIS ke pojok kiri bawah -->
<div id="qrisDownloadAlert" style="display:none; position:fixed; bottom:30px; left:30px; z-index:9999;">
    <div style="background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.2); padding:20px 40px 20px 20px; display:flex; align-items:center; gap:16px; min-width:220px; position:relative;">
        <span style="color:#1E388D; font-size:1.1rem; font-weight:600;">QRIS telah di-download</span>
        <button id="closeQrisAlert" style="background:none; border:none; font-size:1.5rem; color:#888; position:absolute; top:8px; right:12px; cursor:pointer;">&times;</button>
    </div>
</div>

<!-- Popup alert WhatsApp dengan layout tengah dan background hitam transparan -->
<div id="waAlert" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:10000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.2); padding:24px 32px 20px 24px; min-width:260px; position:relative; max-width:90vw;">
        <span style="color:#1E388D; font-size:1.1rem; font-weight:600;">Anda akan berpindah ke gateway WhatsApp</span>
        <button id="closeWaAlert" style="background:none; border:none; font-size:1.5rem; color:#888; position:absolute; top:8px; right:12px; cursor:pointer;">&times;</button>
        <div class="mt-3 text-center">
            <button id="lanjutkanWaBtn" class="btn btn-success w-100">Lanjutkan</button>
        </div>
    </div>
</div>

<script>
document.getElementById('whatsappChatBtn').addEventListener('click', function () {
    // Tampilkan popup WhatsApp di tengah
    var waAlert = document.getElementById('waAlert');
    waAlert.style.display = 'flex';
    waAlert.style.alignItems = 'center';
    waAlert.style.justifyContent = 'center';
});

document.getElementById('closeWaAlert').addEventListener('click', function () {
    document.getElementById('waAlert').style.display = 'none';
});

document.getElementById('lanjutkanWaBtn').addEventListener('click', function () {
    let phone = '6287776719079'; // Nomor WA admin tetap
    let message = `Halo, saya sudah melakukan pemesanan dengan detail sebagai berikut:%0A`;
    message += `Nama: {{ $order->nama ?? '-' }}%0A`;
    message += `No. Telp: {{ $order->telp ?? '-' }}%0A`;
    message += `Catatan Pesanan: {{ $order->catatan_pesanan ?? '-' }}%0A`;
    message += `Alamat Gedung: {{ $order->alamat ?? '-' }}%0A`;
    message += `Kode Pos: {{ $order->kode_pos ?? '-' }}%0A`;
    message += `Pin Alamat: {{ $order->pin_alamat ?? '-' }}%0A`;
    message += `%0ABerikut bukti pembayaran saya :`;

    let whatsappUrl = `https://wa.me/${phone}?text=${message}`;
    window.open(whatsappUrl, '_blank');
    document.getElementById('waAlert').style.display = 'none';
});

document.getElementById('downloadQrisBtn').addEventListener('click', function () {
    const image = document.getElementById('qrisImage');
    const imageUrl = image.src;
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = 'qris.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    // Tampilkan popup alert
    document.getElementById('qrisDownloadAlert').style.display = 'block';
});

// Tutup popup alert saat klik icon silang
document.getElementById('closeQrisAlert').addEventListener('click', function () {
    document.getElementById('qrisDownloadAlert').style.display = 'none';
});

document.getElementById('refreshPaymentBtn').addEventListener('click', function () {
    fetch("{{ route('order.checkStatus', $order->id) }}")
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('orderStatusBadge');
            if (data.status === 'confirmed') {
                badge.className = 'badge bg-success';
                badge.textContent = 'Pembayaran Berhasil';
            } else {
                badge.className = 'badge bg-warning text-dark';
                badge.textContent = 'Pesanan sedang disiapkan';
            }
        })
        .catch(error => {
            console.error("Gagal memuat status:", error);
            alert("Gagal memuat status terbaru.");
        });
});
</script>
@endsection

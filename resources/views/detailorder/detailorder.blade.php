@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold text-primary mb-3">Detail Pesanan</h4>
    <h5 class="text-dark mb-4">SIB{{ str_pad($orders->id, 6, '0', STR_PAD_LEFT) }}</h5>

    <div class="mb-3">
        <label class="form-label">Nama Pembeli</label>
        <input class="form-control" type="text" value="{{ $orders->nama }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" rows="2" readonly>{{ $orders->alamat }}</textarea>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">Kode Pos</label>
            <input class="form-control" type="text" value="{{ $orders->kode_pos }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">Nomor Telepon</label>
            <input class="form-control" type="text" value="{{ $orders->telp }}" readonly>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Pin Alamat</label><br>
        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $orders->latitude }},{{ $orders->longitude }}&zoom=15&size=600x300&markers=color:red%7C{{ $orders->latitude }},{{ $orders->longitude }}&key=YOUR_API_KEY" alt="Map" class="img-fluid rounded shadow">
    </div>

    <h6 class="fw-bold mb-3">Detail Pesanan</h6>
    <ul class="list-group mb-4">
        @foreach($orders->items as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $item->ProdukAir->nama_produk ?? '-' }} - {{ $item->quantity }}x
            <button class="btn btn-sm btn-outline-success">Done</button>
        </li>
        @endforeach
    </ul>

    <button class="btn btn-primary" onclick="showPopup()">Kirim</button>
</div>

{{-- Pop-up konfirmasi --}}
<div id="popup" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none align-items-center justify-content-center">
    <div class="bg-white rounded p-4 text-center shadow" style="width: 300px;">
        <img src="https://cdn-icons-png.flaticon.com/512/893/893257.png" alt="Truck" style="width: 64px;" class="mb-3">
        <p>Pesanan masuk ke dalam pengiriman</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to home</a>
    </div>
</div>

<script>
function showPopup() {
    document.getElementById('popup').classList.remove('d-none');
    document.getElementById('popup').classList.add('d-flex');
}
</script>
@endsection

@extends('layouts.appadmin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/detailorder.css') }}">
@endpush

@section('content')
<div class="detail-container">
    {{-- Judul di luar box --}}
    <div class="container">
        <div class="header-title">Detail Pesanan</div>
    </div>

    <div class="container content-box" style="min-height: 80vh;">
        <h5 class="order-id-title">SIB{{ str_pad($orders->id, 6, '0', STR_PAD_LEFT) }}</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Pembeli</label>
                    <input class="form-control input-biru" type="text" value="{{ $orders->nama }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control input-biru" rows="2" readonly>{{ $orders->alamat }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Kode Pos</label>
                        <input class="form-control input-biru" type="text" value="{{ $orders->kode_pos }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Nomor Telepon</label>
                        <input class="form-control input-biru" type="text" value="{{ $orders->telp }}" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pin Alamat</label><br>
                    <textarea class="form-control input-biru" rows="3" readonly>{{ $orders->pin_alamat }}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <h6 class="fw-bold mb-3">Detail Pesanan</h6>
                <ul class="list-group mb-5">
                    @foreach($orders->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 2px solid #1E388D; font-weight: bold;">
                        {{ $item->ProdukAir->nama_produk ?? '-' }} – <strong class="text-danger">{{ $item->quantity }}X</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Tombol Kirim dan sudah bayar di pojok kanan bawah --}}
        <div class="button-group">
            <button id="btn-bayar" class="btn btn-secondary" onclick="enableKirim()">Sudah Bayar</button>
            <form action="{{ route('admin.order.kirim', $orders->id) }}" method="POST" onsubmit="return showPopup();">@csrf
            <button type="submit" class="btn btn-kirim">Kirim</button>
</form>
        </div>
    </div>
</div>

{{-- Pop-up konfirmasi --}}
<div id="popup" class="popup-overlay d-none">
    <div class="popup-box">
        <img src="{{ asset('images/truck.png') }}" alt="Truck" width="200" class="mb-3">
        <p class="mb-3">Pesanan masuk ke dalam pengiriman</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to home</a>
    </div>
</div>

<script>
    function enableKirim() {
        const kirimBtn = document.getElementById('btn-kirim');
        kirimBtn.disabled = false;

        const bayarBtn = document.getElementById('btn-bayar');
        bayarBtn.classList.add('disabled');
        bayarBtn.setAttribute('disabled', true);
        bayarBtn.innerText = 'Sudah Dibayar';
    }

    function showPopup() {
        const popup = document.getElementById('popup');
        popup.classList.remove('d-none');
        popup.classList.add('d-flex');
        return true;
    }
</script>
@endsection

@extends('layouts.appuser')

@section('content')
<div class="position-relative">
    <!-- Map -->
    <div id="map"></div>

    <!-- Wrapper absolute bawah, isi 2 komponen sejajar -->
    <div class="position-absolute bottom-0 start-0 w-100 z-3 d-flex justify-content-center p-4" style="pointer-events: none;">
        
        <!-- Form Lokasi -->
        <div class="bg-white border rounded shadow p-4 me-3" style="width: 300px; pointer-events: auto;">
            <h5 class="text-center fw-bold text-primary mb-3">Select Location</h5>
            <!-- Form -->
            <div class="position-relative mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill text-gray-600"></i>
                    <input type="text" id="fromLocation" placeholder="Enter location"
                        class="form-control form-control-sm" autocomplete="off" />
                </div>
                <ul id="fromSuggestions" class="list-group position-absolute w-100 mt-1 z-50"
                    style="max-height: 150px; overflow-y: auto; display: none;"></ul>
            </div>
            <button class="btn btn-primary w-100 btn-sm">Place Order</button>
        </div>

        <!-- Produk Air Horizontal -->
        <div class="bg-white border rounded shadow p-4" style="pointer-events: auto; max-width: 900px; overflow-x: auto;">
            <h6 class="fw-bold mb-3 text-center" style="color: #1E388D">Ukuran dan Jenis Air yang tersedia</h6>
            <div class="d-flex gap-3 flex-nowrap">
                @foreach ($produk as $p)  
                    <div class="card text-center border-primary flex-shrink-0" style="width: 120px;">
                    <h5 class="text-muted">{{ $p->satuan }}L</h5>
                        <div class="card-body p-2">
                            <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama }}"
                                 class="img-fluid mb-2" style="max-height: 60px;">
                            <h6 class="fw-semibold small mb-1">{{ $p->nama_produk }}</h6>
                            <!-- Product Price -->
                            <p class="mt-2 text-primary" style="color: #1E388D">{{ $p->harga }}</p>

                            <!-- Quantity Controls -->
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity({{ $p->id }})">-</button>
                                <input type="number" id="quantity-{{ $p->id }}" value="0" class="form-control form-control-sm text-center" style="width: 50px;" readonly />
                                <button class="btn btn-sm btn-outline-secondary" onclick="increaseQuantity({{ $p->id }})">+</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
<style>
    #map {
        height: 100vh;
        z-index: 0 !important;
        position: relative;
    }

    .leaflet-top.leaflet-right {
        margin-top: 70px;
        margin-right: 10px;
    }

    .z-3 {
        z-index: 1030;
    }

    .card-body {
        padding: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
<script>
    function increaseQuantity(productId) {
        let quantityInput = document.getElementById(`quantity-${productId}`);
        let currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
    }

    function decreaseQuantity(productId) {
        let quantityInput = document.getElementById(`quantity-${productId}`);
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 0) {
            quantityInput.value = currentQuantity - 1;
        }
    }
</script>
@endpush

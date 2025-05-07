@extends('layouts.appuser')

@section('content')
<div class="position-relative">
    <!-- Map -->
    <div id="map"></div>

    <!-- Wrapper absolute bawah -->
    <div class="position-absolute bottom-0 start-0 w-100 z-3 d-flex justify-content-center p-3" style="pointer-events: none;">
        
        <!-- Form Lokasi -->
        <div class="bg-white border rounded shadow-sm p-3 me-2" style="width: 250px; pointer-events: auto;">
            <h6 class="text-center fw-bold text-primary mb-3">Select Location</h6>
            <form id="orderForm" method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="position-relative mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-gray-600"></i>
                        <input type="text" id="fromLocation" name="alamat" placeholder="Enter location"
                            class="form-control form-control-sm" autocomplete="off" required />
                    </div>
                    <ul id="fromSuggestions" class="list-group position-absolute w-100 mt-1 z-50"
                        style="max-height: 150px; overflow-y: auto; display: none;"></ul>
                </div>
                
                <!-- Hidden inputs for quantity -->
                @foreach ($produk as $p)
                    <input type="hidden" name="quantity[{{ $p->id }}]" id="quantity-{{ $p->id }}-input" value="0">
                @endforeach

                <button type="submit" class="btn btn-primary w-100 btn-sm">Place Order</button>
            </form>
        </div>

        <!-- Produk Air Horizontal -->
        <div class="bg-white border rounded shadow-sm p-3" style="pointer-events: auto; max-width: 700px; overflow-x: auto;">
            <h6 class="fw-bold mb-3 text-center text-primary">Ukuran dan Jenis Air</h6>
            <div class="d-flex gap-3 flex-nowrap">
                @foreach ($produk as $p)  
                    <div class="card text-center border-primary flex-shrink-0" style="width: 140px; padding: 10px;">
                        <h6 class="text-muted small mt-2">{{ $p->satuan }}L</h6>
                        <div class="card-body p-2">
                            <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama }}" class="img-fluid mb-2" style="max-height: 50px;">
                            <h6 class="fw-semibold small mb-1">{{ $p->nama_produk }}</h6>
                            <p class="text-primary small mb-2">{{ $p->harga }}</p>

                            <!-- Quantity Controls - Adjusted with gap and align-items-center -->
                            <div class="d-flex gap-2 align-items-center justify-content-center flex-nowrap" style="width: 100%;">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity({{ $p->id }})">-</button>
                                <input type="number" id="quantity-{{ $p->id }}" value="0" class="form-control form-control-sm text-center" style="width: 50px;" readonly />
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="increaseQuantity({{ $p->id }})">+</button>
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
        position: relative;
        z-index: 0 !important;
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
    
    /* Ensure input can display larger numbers */
    input[type="number"] {
        min-width: 60px;
    }
    
    /* Adjust card width to accommodate wider input */
    .card.text-center {
        width: 110px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
<script>
    function increaseQuantity(productId) {
        let quantityInput = document.getElementById(`quantity-${productId}`);
        let currentQuantity = parseInt(quantityInput.value) || 0;
        // No upper limit on quantity
        quantityInput.value = currentQuantity + 1;

        // Update hidden input
        document.getElementById(`quantity-${productId}-input`).value = quantityInput.value;

        // Remove error if exists
        const err = document.getElementById('product-error-message');
        if (err) err.remove();
    }

    function decreaseQuantity(productId) {
        let quantityInput = document.getElementById(`quantity-${productId}`);
        let currentQuantity = parseInt(quantityInput.value) || 0;
        if (currentQuantity > 0) {
            quantityInput.value = currentQuantity - 1;
        }

        // Update hidden input
        document.getElementById(`quantity-${productId}-input`).value = quantityInput.value;
    }

    // Validasi submit form
    document.getElementById('orderForm').addEventListener('submit', function(event) {
        let valid = false;
        document.querySelectorAll('input[name^="quantity["]').forEach((input) => {
            if (parseInt(input.value) > 0) valid = true;
        });

        if (!valid) {
            event.preventDefault();
            if (!document.getElementById('product-error-message')) {
                const error = document.createElement('div');
                error.id = 'product-error-message';
                error.className = 'alert alert-danger mt-2 small';
                error.textContent = 'Please select at least one product';
                this.querySelector('button[type="submit"]').after(error);
            }
        }
    });
</script>
@endpush

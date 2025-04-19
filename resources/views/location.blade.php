@extends('layouts.appuser')

@section('content')
<div class="position-relative">
    <!-- Map -->
    <div id="map"></div>

    <!-- Floating Form -->
    <div class="position-absolute top-0 start-0 mt-4 ms-4 z-3 bg-white border rounded shadow p-4" style="width: 320px;">
        <h5 class="text-center fw-bold text-primary mb-3">Select Location</h5>

      <!-- Lokasi Asal -->
<div class="position-relative mb-3">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-geo-alt-fill text-gray-600"></i>
        <input type="text" id="fromLocation" placeholder="Lokasi Asal"
            class="form-control form-control-sm" autocomplete="off" />
    </div>
    <ul id="fromSuggestions" class="list-group position-absolute w-100 mt-1 z-50" style="max-height: 150px; overflow-y: auto; display: none;"></ul>
</div>

        <!-- Lokasi Tujuan -->
<div class="position-relative">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-person-fill text-gray-600"></i>
        <input type="text" id="toLocation" placeholder="Lokasi Tujuan"
            class="form-control form-control-sm" autocomplete="off" />
    </div>
    <ul id="toSuggestions" class="list-group position-absolute w-100 mt-1 z-50" style="max-height: 150px; overflow-y: auto; display: none;"></ul>
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

    .z-3 {
        z-index: 1030;
    }
    .leaflet-top.leaflet-right {
    margin-top: 70px;
    margin-right: 10px;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endpush



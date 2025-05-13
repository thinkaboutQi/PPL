@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold text-primary">SIBESI : Solusi Air Bersih untuk Kebutuhan Anda!</h1>
        </div>
        <div class="col-md-4">
            <img src="https://via.placeholder.com/300x200" alt="Air Bersih" class="img-fluid rounded">
        </div>
    </div>

    <!-- Search Section -->
    <div class="mb-4">
        <h4 class="fw-bold text-primary">Temukan Toko Terdekat!</h4>
        <div class="row g-2">
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Kota</option>
                    <option value="1">Jakarta</option>
                    <option value="2">Bandung</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Kecamatan</option>
                    <option value="1">Setiabudi</option>
                    <option value="2">Cilandak</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Kelurahan</option>
                    <option value="1">Manggarai</option>
                    <option value="2">Lebak Bulus</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Cari <i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>

    <!-- List Item Section -->
    <div>
        <h4 class="fw-bold text-primary mb-3">List Item</h4>
        <div class="d-flex gap-3 flex-wrap">
            <div class="card text-center border-primary" style="width: 140px;">
                <img src="https://via.placeholder.com/100" class="card-img-top p-3" alt="Galon Air">
                <div class="card-body">
                    <h6 class="card-title fw-bold">14L</h6>
                    <p class="text-muted small">Galon Air</p>
                </div>
            </div>
            <div class="card text-center border-primary" style="width: 140px;">
                <img src="https://via.placeholder.com/100" class="card-img-top p-3" alt="Truk Air Bersih">
                <div class="card-body">
                    <h6 class="card-title fw-bold">150L</h6>
                    <p class="text-muted small">Truk Air Bersih</p>
                </div>
            </div>
            <div class="card text-center border-primary" style="width: 140px;">
                <img src="https://via.placeholder.com/100" class="card-img-top p-3" alt="Truk Air Minum">
                <div class="card-body">
                    <h6 class="card-title fw-bold">150L</h6>
                    <p class="text-muted small">Truk Air Minum</p>
                </div>
            </div>
            <div class="card text-center border-primary" style="width: 140px;">
                <img src="https://via.placeholder.com/100" class="card-img-top p-3" alt="Tangki 1/2">
                <div class="card-body">
                    <h6 class="card-title fw-bold">75L</h6>
                    <p class="text-muted small">Tangki 1/2</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

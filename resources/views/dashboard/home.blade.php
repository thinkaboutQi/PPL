@extends('layouts.appuser')

@section('content')
<div class="container-fluid py-5 px-4" style="background-color: #1E388D; color: #ffffff; border-radius: 0px;">
    <!-- Header Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold" style="color: #ffffff;">SIBESI : Solusi Air Bersih untuk Kebutuhan Anda!</h1>
        </div>
        <div class="col-md-6">
            <img src="https://via.placeholder.com/500x300" alt="Air Bersih" class="img-fluid rounded">
        </div>
    </div>

    {{-- Panggil Livewire component cari toko --}}
    @livewire('cari-toko')

    <!-- List Item Section -->
 <!-- List Item Section -->
<div class="px-4 py-5">
    <h4 class="fw-bold mb-4" style="color:#1E388D;">List Item</h4>
    <div class="d-flex gap-4 flex-wrap justify-content-center">
        @foreach($produk as $p)
            <div class="card text-center border-primary" style="width: 150px; border-color: #ffffff; background-color: #1E388D;">
            <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama }}" class="img-fluid mb-2;">
                <div class="card-body">
                    <h6 class="card-title fw-bold" style="color: #ffffff;">{{ $p->nama_produk }}</h6>
                    <p class="text-muted small" style="color: #ffffff;">{{ $p->satuan }} L</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

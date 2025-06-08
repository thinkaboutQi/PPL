@extends('layouts.appuser')

@section('content')
<div class="container-fluid py-4 px-2" style="background-color: #314a8a; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-12" style="max-width: 1200px;">
            <div class="row align-items-center mb-4" style="background: #fff; border-radius: 20px; overflow: hidden;">
                <div class="col-md-6 p-5">
                    <h1 class="fw-bold" style="color: #223D93; font-size: 2.2rem; line-height: 1.3;">
                        SIBESI : Solusi Air<br>Bersih untuk<br>Kebutuhan Anda!
                    </h1>
                </div>
                <div class="col-md-6 p-0">
                    <img src="https://assets.onecompiler.app/43gzrskdv/43m6fqrhb/ilustrasi-air-bersih.jpg"
                        alt="Air Bersih"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 0 20px 20px 0; min-height: 240px; max-height: 320px;">
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan margin-bottom agar tidak dempet ke tulisan bawahnya -->
    <div style="height: 32px;"></div>
    {{-- Panggil Livewire component cari toko --}}
    @livewire('cari-toko')

    <!-- List Item Section -->
    <div class="px-0 py-5 d-flex justify-content-center" style="background: #fff; border-radius:24px; box-shadow: 0 8px 32px 0 rgba(44,62,80,0.08); max-width: 1200px; margin: 0 auto;">
        <div style="width: 95%;">
            <h4 class="fw-bold mb-4 ps-4" style="color:#223D93; font-size:1.5rem;">List item</h4>
            <div class="d-flex gap-4 flex-wrap justify-content-center" style="overflow-x: auto; padding-bottom: 8px;">
                @foreach($produk as $p)
                    <div class="card text-center border-0 shadow-sm flex-shrink-0" style="width: 180px; border-radius: 18px; background: #223D93;">
                        <div class="pt-4 pb-2 px-2">
                            <div class="fw-bold" style="color:#fff; font-size:1.1rem;">{{ $p->satuan }} L</div>
                        </div>
                        <div style="background: transparent; display: flex; justify-content: center; align-items: center; height: 90px;">
                            <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama }}" class="img-fluid mb-2" style="height: 80px; object-fit: contain; background: transparent; box-shadow: none;">
                        </div>
                        <div class="card-body pt-0 pb-4">
                            <div class="fw-semibold" style="color:#fff;">{{ $p->nama_produk }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

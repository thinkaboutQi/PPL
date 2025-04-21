@extends('layouts.appuser')

@section('content')
<div class="c_order-frame">
    <div class="c_order-frame01">
      <div class="c_order-text">
        <p class="c_order-text01">SIBESI : Solusi Air Bersih untuk Kebutuhan Anda!</p>
      </div>
      <img
        src="https://assets.onecompiler.app/42vbxdd3a/43f9kt8bp/c365e850e7b89cf381cfb9fb06806452.png"
        alt="Banner SIBESI"
        class="c_order-frame02"
      />
    </div>

    <div class="c_order-text02">
      <p class="c_order-text03">Ukuran dan Jenis Air yang tersedia</p>
    </div>

    <div class="c_order-frame03">
      <div class="c_order-frame04" style="display: flex; gap: 50px; flex-wrap: wrap;">

        <!-- mobil tanki air Truk Tangki Air Bersih -->
        <div class="container mt-4">
    <div class="row">
        @foreach($produk as $p)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($p->gambar) }}" class="card-img-top" alt="{{ $p->nama_produk }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->nama_produk }}</h5>
                        <p class="card-text">Harga: <strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong></p>
                        <p class="card-text">Satuan: {{ $p->satuan }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
    </div>
  </div>
@endsection

@extends('layouts.appadmin')

@section('content')
@php
    $totalOrder = \App\Models\Order::count('id');
    $orders = \App\Models\Order::with('items.ProdukAir')->latest()->get();
    $inProgress = $orders->where('status', 'pending')->count();
    $shipping = $orders->where('status', 'paid')->count();
@endphp
<div style="background: #2949A9; min-height: 100vh; padding: 0;">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="bg-white rounded shadow d-flex flex-row align-items-center justify-content-start p-4 h-100">
                    <img src="{{ asset('https://assets.onecompiler.app/42vbxdd3a/43kcd75av/Order.png') }}" alt="Order" style="width: 60px; margin-right: 24px;">
                    <div class="d-flex flex-column align-items-start">
                        <div class="fw-bold" style="font-size: 1.1rem;">Total Order</div>
                        <div class="display-4 fw-bold" style="color: #2949A9;">{{ $totalOrder }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="bg-white rounded shadow d-flex flex-row align-items-center justify-content-start p-4 h-100">
                    <img src="{{ asset('https://assets.onecompiler.app/42vbxdd3a/43kcd75av/Order%20(1).png') }}" alt="Order" style="width: 60px; margin-right: 24px; border: 3px solid #F15A29; border-radius: 4px;">
                    <div class="d-flex flex-column align-items-start">
                        <div class="fw-bold" style="font-size: 1.1rem;">In progress</div>
                        <div class="display-4 fw-bold" style="color: #2949A9;">{{ $inProgress }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="bg-white rounded shadow d-flex flex-row align-items-center justify-content-start p-4 h-100">
                    <img src="{{ asset('https://assets.onecompiler.app/42vbxdd3a/43kcd75av/Shipping.png') }}" alt="Shipping" style="width: 60px; margin-right: 24px;">
                    <div class="d-flex flex-column align-items-start">
                        <div class="fw-bold" style="font-size: 1.1rem;">Shipping</div>
                        <div class="display-4 fw-bold" style="color: #2949A9;">{{ $shipping }}</div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold text-white mb-3">To deliver</h4>
        <div class="bg-white rounded shadow p-3">
            <table class="table table-bordered align-middle mb-0" style="border-radius: 10px; overflow: hidden;">
                <thead style="background: #2949A9; color: #fff;">
                    <tr>
                        <th>ID PESANAN</th>
                        <th>Detail pesanan</th>
                        <th>Catatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Ambil semua order beserta relasi items dan produk
                        $orders = \App\Models\Order::with('items.ProdukAir')->latest()->get();
                    @endphp
                    @forelse($orders as $order)
                        <tr>
                            <td class="fw-bold text-primary">SIB{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    <div>{{ $item->ProdukAir->nama_produk ?? '-' }} x{{ $item->quantity }}</div>
                                @endforeach
                            </td>
                            <td class="text-primary">{{ $order->catatan_pesanan ?? '-' }}</td>
                            <td><a href="{{ route('DetailOrder', ['id' => $order->id]) }}" class="btn btn-primary w-100">Detail</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

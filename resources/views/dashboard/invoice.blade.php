@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded p-4 mx-auto" style="max-width: 700px;">
        <h3 class="fw-bold mb-4" style="color:#2949A9;">Invoice Pembelian</h3>
        <div class="mb-3">
            <div><b>ID Pesanan:</b> SIB{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div><b>Tanggal:</b> {{ $order->created_at->format('Y-m-d H:i') }}</div>
            <div><b>Pembeli:</b> {{ $order->user->name ?? '-' }}</div>
            <div><b>Email:</b> {{ $order->user->email ?? '-' }}</div>
            <div><b>Alamat:</b> {{ $order->user->alamat ?? '-' }}</div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->ProdukAir->nama_produk ?? '-' }}</td>
                            <td>Rp {{ number_format($item->ProdukAir->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format(($item->ProdukAir->harga ?? 0) * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @php $total += ($item->ProdukAir->harga ?? 0) * $item->quantity; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex gap-2 mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary no-print">Kembali</a>
            <button onclick="window.print()" class="btn btn-outline-primary no-print">Cetak Invoice</button>
        <form action="{{ route('admin.invoice.send', ['order' => $order->id]) }}" method="POST" class="d-inline no-print">
            @csrf
            <button type="submit" class="btn btn-success">Kirim Invoice ke User</button>
        </form>
        </div>
    </div>
</div>
@endsection

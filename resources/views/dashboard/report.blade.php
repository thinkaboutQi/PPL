@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Laporan Penjualan</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="from" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="from" name="from" value="{{ request('from') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="to" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="to" name="to" value="{{ request('to') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @php
                $orders = \App\Models\Order::with('user')
                    ->when(request('from'), function($q) {
                        $q->whereDate('created_at', '>=', request('from'));
                    })
                    ->when(request('to'), function($q) {
                        $q->whereDate('created_at', '<=', request('to'));
                    })
                    ->latest()->get();
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>No. Invoice</th>
                            <th>User</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->invoice_number ?? 'SIB' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>Rp{{ number_format($order->total,0,',','.') }}</td>
                            <td>
                                @if($order->status == 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.appadmin')

@section('content')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Invoice Per User</h2>
    @php
        $grouped = $orders->groupBy('user_id');
    @endphp
    @forelse($grouped as $userId => $userOrders)
        <div class="mb-5">
            <h5 class="fw-bold mb-3" style="color:#2949A9;">
                {{ $userOrders->first()->user->name ?? 'User Tidak Diketahui' }}
            </h5>
            <div class="bg-white rounded shadow p-3">
                <table class="table table-bordered align-middle mb-0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: #2949A9; color: #fff;">
                        <tr>
                            <th>ID Invoice</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userOrders as $order)
                            <tr>
                                <td class="fw-bold text-primary">SIB{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.invoice.show', ['order' => $order->id]) }}" class="btn btn-info btn-sm">Detail</a>
                                    <form action="{{ route('admin.invoice.send', ['order' => $order->id]) }}" method="POST" class="d-inline" style="margin-left:2px;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Kirim Invoice ke User</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Tidak ada data invoice.</div>
    @endforelse
</div>
@endsection

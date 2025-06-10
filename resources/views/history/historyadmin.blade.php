<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4" style="color: #2949A9;">History Pesanan</h4>
    <div class="mb-3">
        <button id="filterBtn" class="btn btn-primary" style="background: #2949A9; border: none;">
            <i class="bi bi-funnel-fill me-1"></i> Filter
        </button>
    </div>
    <!-- Popup Filter -->
    <div id="filterModal" class="modal" tabindex="-1" style="display:none; background:rgba(0,0,0,0.3); position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999;">
        <div class="modal-dialog" style="max-width:400px; margin:10vh auto;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Pesanan</h5>
                    <button type="button" class="btn-close" id="closeFilterModal"></button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" method="GET" action="{{ route('admin.history') }}">
                        <div class="mb-3">
                            <label for="filterTanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="filterTanggal" name="tanggal" value="{{ request('tanggal') }}">
                        </div>
                        <div class="mb-3">
                            <label for="filterStatus" class="form-label">Status</label>
                            <select class="form-select" id="filterStatus" name="status">
                                <option value="">Semua</option>
                                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>In Progress</option>
                                <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Shipping</option>
                                <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded shadow p-3">
        <table class="table table-bordered align-middle mb-0" style="border-radius: 10px; overflow: hidden;">
            <thead style="background: #2949A9; color: #fff;">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Kode Pos</th>
                    <th>Pin Alamat</th>
                    <th>Catatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold text-primary">SIB{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->telp }}</td>
                        <td>{{ $order->alamat }}</td>
                        <td>{{ $order->kode_pos }}</td>
                        <td>{{ $order->pin_alamat }}</td>
                        <td>{{ $order->catatan_pesanan ?? '-' }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning text-dark">In Progress</span>
                            @elseif($order->status === 'paid')
                                <span class="badge bg-info text-dark">Shipping</span>
                            @elseif($order->status === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('filterBtn').onclick = function() {
        document.getElementById('filterModal').style.display = 'block';
    };
    document.getElementById('closeFilterModal').onclick = function() {
        document.getElementById('filterModal').style.display = 'none';
    };
    document.getElementById('filterForm').onsubmit = function() {
        document.getElementById('filterModal').style.display = 'none';
        return true;
    };
    document.getElementById('filterModal').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
</script>
@endpush
</body>
</html>
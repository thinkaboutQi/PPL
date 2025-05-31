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
</body>
</html>
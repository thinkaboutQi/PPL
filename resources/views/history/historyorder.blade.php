@extends('layouts.appuser')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-4" style="color: #1E388D;">History Pesanan</h2>

        <div class="mb-4">
            <button class="px-4 py-2 rounded text-white" style="background-color: #1E388D;">
                Filter
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 table-auto w-full">
                <thead>
                    <tr style="background-color: #1E388D; color: white;">
                        <th class="px-4 py-2 border">Tanggal Pesanan</th>
                        <th class="px-4 py-2 border">Total Pesanan</th>
                        <th class="px-4 py-2 border">Pesanan</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-center">
                                {{ $order->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-2 border text-center">
                                {{ $order->items->sum('quantity') }}
                            </td>
                            <td class="px-4 py-2 border">
                                <ul class="list-disc list-inside">
                                    @foreach ($order->items as $item)
                                        <li>
                                            {{ $item->produkAir->nama_produk ?? 'Produk tidak ditemukan' }}
                                            ({{ $item->quantity }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2 border text-right">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-4 py-2">Tidak ada data pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

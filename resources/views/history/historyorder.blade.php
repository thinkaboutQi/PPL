@extends('layouts.appuser')

@section('content')
<div style="background: #223D93; min-height: 100vh; padding: 0; margin: 0;">
    <div class="container-fluid px-0" style="padding-top: 24px;">
        <h2 class="fw-bold mb-4" style="color: #fff; font-size: 2.2rem; padding-left: 2vw;">History</h2>
        <div class="mx-auto" style="background: #fff; border-radius: 16px; max-width: 94vw; margin-bottom: 32px; padding-left: 24px; padding-right: 24px; min-height: 70vh; display: flex; flex-direction: column;">
            <div class="p-4 pb-0">
                <button id="filterBtn" class="px-4 py-2 rounded" style="background-color: #223D93; color: #fff; font-weight: 600; border: none;">
                    Filter
                </button>
            </div>
            <!-- Popup Filter -->
            <div id="filterModal" class="modal" tabindex="-1" style="display:none; background:rgba(0,0,0,0.3); position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999;">
                <div class="modal-dialog" style="max-width:400px; margin:10vh auto;">
                    <div class="modal-content" style="border-radius:12px;">
                        <div class="modal-header">
                            <h5 class="modal-title">Filter Riwayat</h5>
                            <button type="button" class="btn-close" id="closeFilterModal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="filterForm" method="GET" action="">
                                <div class="mb-3">
                                    <label for="filterTanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="filterTanggal" name="tanggal" value="{{ request('tanggal') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="filterProduk" class="form-label">Produk</label>
                                    <input type="text" class="form-control" id="filterProduk" name="produk" placeholder="Nama produk" value="{{ request('produk') }}">
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="applyFilter">Terapkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="flex: 1;">
                <table class="table mb-0" style="border-collapse: separate; border-spacing: 0; min-width: 100%;">
                    <thead>
                        <tr style="background: #fff; color: #222; border-bottom: 1.5px solid #888;">
                            <th class="text-center align-middle" style="font-weight: bold; font-size: 1.1rem; border-right: 1px solid #bbb;">Tgl Pesanan</th>
                            <th class="text-center align-middle" style="font-weight: bold; font-size: 1.1rem; border-right: 1px solid #bbb;">Total Pesanan</th>
                            <th class="text-center align-middle" style="font-weight: bold; font-size: 1.1rem; border-right: 1px solid #bbb;">Pesanan</th>
                            <th class="text-center align-middle" style="font-weight: bold; font-size: 1.1rem;">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr style="border-bottom: 1px solid #bbb;">
                            <td class="text-center align-middle" style="border-right: 1px solid #eee;">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="text-center align-middle" style="border-right: 1px solid #eee;">{{ $order->items->sum('quantity') }}</td>
                            <td class="align-middle" style="border-right: 1px solid #eee;">
                                <ul class="mb-0 ps-3" style="list-style: disc inside;">
                                    @foreach ($order->items as $item)
                                        <li>
                                            {{ $item->produkAir->nama_produk ?? 'Produk tidak ditemukan' }}
                                            ({{ $item->quantity }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center align-middle">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Tidak ada data pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
    // Form submit otomatis reload dengan parameter filter
    document.getElementById('filterForm').onsubmit = function() {
        document.getElementById('filterModal').style.display = 'none';
        return true;
    };
    // Tutup modal jika klik di luar modal-content
    document.getElementById('filterModal').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
</script>
@endpush

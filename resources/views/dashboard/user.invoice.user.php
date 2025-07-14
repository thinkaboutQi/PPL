<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
        <span><i class="bi bi-receipt"></i> Invoice Saya</span>
        <a href="{{ route('user.invoice.user') }}" class="btn btn-sm btn-light"><i class="bi bi-list"></i> Lihat Semua</a>
    </div>
    <div class="card-body">
        @php
            $invoices = \App\Models\Order::where('user_id', auth()->id())->latest()->take(5)->get();
        @endphp
        @if($invoices->isEmpty())
            <div class="alert alert-info mb-0">Belum ada invoice.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>No. Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                            <td>Rp{{ number_format($invoice->total,0,',','.') }}</td>
                            <td>
                                @if($invoice->status == 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.invoice.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

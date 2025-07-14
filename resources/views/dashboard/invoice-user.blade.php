@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Sidebar Pengaturan (contoh penempatan Invoice) -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="list-group shadow-sm">
                <a href="#" class="list-group-item list-group-item-action disabled bg-primary text-white fw-bold">
                    Pengaturan
                </a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-moon"></i> Dark mode</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-geo-alt"></i> Alamat Tersimpan</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-question-circle"></i> Pusat Bantuan</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-shield-lock"></i> Keamanan akun</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-text"></i> Syarat & Ketentuan</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-right"></i> Log out</a>
                <a href="{{ route('user.invoice.user') }}" class="list-group-item list-group-item-action invoice">
                    <i class="bi bi-receipt"></i> Invoice
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-receipt"></i> Invoice Saya</span>
                </div>
                <div class="card-body">
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
        </div>
    </div>
</div>
@endsection

@extends('layouts.electra')

@section('title', '📄 Laporan Transaksi')

@section('content')
<div class="container">
    <h2 class="mb-4">📄 Laporan Transaksi</h2>

        {{-- Tombol Export PDF --}}
    <a href="{{ route('admin.reports.pdf') }}" class="btn btn-danger mb-3">⬇️ Export PDF</a>
    
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Total Transaksi:</strong> {{ $totalTransaksi }}</p>
            <p><strong>Total Pemasukan:</strong> Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            <p><strong>Total Token Terjual:</strong> {{ $totalTokenTerjual }} kWh</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">Detail Transaksi</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Token</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tx->user->name ?? '-' }}</td>
                            <td>{{ $tx->token->nama ?? '-' }}</td>
                            <td>{{ $tx->jumlah }}</td>
                            <td>Rp{{ number_format($tx->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $tx->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

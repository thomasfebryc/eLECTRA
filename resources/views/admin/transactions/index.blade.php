@extends('layouts.electra')

@section('title', 'Riwayat Transaksi Token & Tagihan Listrik')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Transaksi Token & Tagihan Listrik</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filter --}}
    <form action="{{ route('admin.transactions.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="user" class="form-control" placeholder="Cari Nama User" value="{{ request('user') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-md-2 text-end">
            <a href="{{ route('admin.transactions.pdf') }}" class="btn btn-danger" target="_blank">⬇️ PDF</a>
            <button type="button" onclick="window.print()" class="btn btn-success">🖨️ Cetak</button>
        </div>
    </form>

    {{-- TABEL TOKEN LISTRIK --}}
    <h4 class="mt-5">🧾 Transaksi Token Listrik</h4>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Nama Token</th>
                <th>Jumlah Dibeli (kWh)</th>
                <th>Total Harga (Rp)</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->token->nama }}</td>
                <td>{{ $transaction->jumlah }}</td>
                <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                <td>
                    <span class="badge bg-{{ $transaction->status == 'paid' ? 'success' : 'warning' }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>
                <td>
                    @php
                        $confirmation = $transaction->confirmation;
                    @endphp

                    @if($confirmation)
                        <a href="{{ route('admin.confirmations.show', $confirmation->id) }}" class="btn btn-sm btn-info mb-1">
                            🔍 Lihat Konfirmasi
                        </a>
                        @if($transaction->status != 'paid')
                        <form action="{{ route('admin.transactions.markPaid', $transaction->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Tandai transaksi ini sudah dibayar?')">
                                ✅ Tandai Sudah Dibayar
                            </button>
                        </form>
                        @endif
                    @else
                        <span class="text-muted">Belum ada konfirmasi</span>
                    @endif

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                            🗑️ Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">Belum ada transaksi token.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TABEL TAGIHAN LISTRIK --}}
    <h4 class="mt-5">💡 Pembayaran Tagihan Listrik</h4>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama User</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>kWh</th>
                <th>Total Bayar</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $bill)
            <tr>
                <td>{{ $bill->user->name }} ({{ $bill->customerId }})</td>
                <td>{{ $bill->month }}</td>
                <td>{{ $bill->year }}</td>
                <td>{{ $bill->units }}</td>
                <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                <td>{{ $bill->updated_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada pembayaran tagihan listrik.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

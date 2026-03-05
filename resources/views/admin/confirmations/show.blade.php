@extends('layouts.electra')

@section('title', 'Detail Konfirmasi Pembayaran')

@section('content')
<div class="container">
    <h2 class="mb-4">🔍 Detail Konfirmasi Pembayaran</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nama User:</strong> {{ $confirmation->transaction->user->name }}</p>
            <p><strong>Token:</strong> {{ $confirmation->transaction->token->nama }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($confirmation->transaction->total_harga, 0, ',', '.') }}</p>
            <p><strong>Tanggal Konfirmasi:</strong> {{ $confirmation->created_at->format('d M Y H:i') }}</p>
            <p><strong>Catatan:</strong> {{ $confirmation->catatan ?? '-' }}</p>

            @if($confirmation->bukti_transfer)
                <p><strong>Bukti Transfer:</strong></p>
                <img src="{{ asset('storage/' . $confirmation->bukti_transfer) }}" alt="Bukti Transfer" class="img-fluid rounded border" style="max-height: 400px;">
            @else
                <p class="text-muted">Belum ada bukti transfer.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection

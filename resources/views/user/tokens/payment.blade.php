@extends('layouts.user')

@section('title', 'Pembayaran Token')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-white">🧾 Detail Pembayaran Token</h2>

    {{-- Informasi Token --}}
    <div class="card mb-4 border-info shadow">
        <div class="card-header bg-info text-white">
            <strong>📦 Informasi Token</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-4 text-muted">Kode Token</div>
                <div class="col-sm-8"><strong class="text-dark">{{ $token->kode ?? 'Token tidak ditemukan' }}</strong></div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4 text-muted">Daya</div>
                <div class="col-sm-8"><span class="badge bg-secondary">{{ $token->daya ?? 'Tidak tersedia' }} VA</span></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-muted">Total Harga</div>
                <div class="col-sm-8 text-success"><strong>Rp {{ number_format($transaction->total_harga ?? 0, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>

    {{-- Informasi Pembayaran --}}
    <div class="card border-success shadow">
        <div class="card-header bg-success text-white">
            <strong>💳 Metode Pembayaran: {{ strtoupper($payment['metode'] ?? 'Tidak ada metode') }}</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-4 text-muted">Nama Penerima</div>
                <div class="col-sm-8">{{ $payment['nama_penerima'] ?? 'Tidak ada nama penerima' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4 text-muted">No Tujuan</div>
                <div class="col-sm-8">{{ $payment['nomor_tujuan'] ?? 'Tidak ada nomor tujuan' }}</div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-muted">Bank</div>
                <div class="col-sm-8">{{ $payment['nama_bank'] ?? 'Tidak ada nama bank' }}</div>
            </div>
        </div>
    </div>

    {{-- Tombol Konfirmasi Pembayaran --}}
    <div class="mt-3">
        <a href="{{ route('user.tokens.confirm.form', ['transaction' => $transaction->id]) }}" class="btn btn-primary w-100">Konfirmasi Pembayaran</a>
    </div>

    {{-- Tombol Aksi --}}
    <div class="text-end mt-4">
        <a href="{{ route('user.tokens.index') }}" class="btn btn-outline-primary">
            ← Kembali ke Halaman Token
        </a>
    </div>
</div>
@endsection

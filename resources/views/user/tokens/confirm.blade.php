@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">🧾 Konfirmasi Pembayaran</h2>

    {{-- Pesan Error --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form Konfirmasi Pembayaran --}}
    <form action="{{ route('user.tokens.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
            <input type="file" name="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror">
            @error('bukti_transfer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (opsional)</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">✅ Kirim Konfirmasi</button>
        <a href="{{ route('user.tokens.index') }}" class="btn btn-secondary">← Batal</a>
    </form>
</div>
@endsection

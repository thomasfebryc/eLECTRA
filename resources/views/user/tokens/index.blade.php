@extends('layouts.user')

@section('title', 'Pembelian Token')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-light text-center">⚡ Daftar Token Listrik Tersedia</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Token List --}}
    <div class="row">
        @forelse($tokens as $token)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">🔢 Kode Token: {{ $token->kode }}</h5>
                        <p class="mb-1">⚡ Daya: <strong>{{ $token->daya }} VA</strong></p>
                        <p class="mb-1">🎚️ Kapasitas: <strong>{{ $token->nominal }} kWh</strong></p>
                        <p class="mb-3">💰 Harga: <strong>Rp{{ number_format($token->harga, 0, ',', '.') }}</strong></p>
                        <p class="mb-3">📦 Stok: <strong>{{ $token->stok }}</strong></p>

                        {{-- Form Pembelian --}}
                        <form action="{{ route('user.tokens.purchase') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token_id" value="{{ $token->id }}">
                            <button type="submit" class="btn btn-primary w-100">🔌 Beli Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">❗ Tidak ada token tersedia saat ini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

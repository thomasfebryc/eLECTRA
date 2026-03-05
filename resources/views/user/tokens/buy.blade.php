@extends('layouts.user')

@section('title', 'Pembelian Token')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg glassmorphism px-4 py-4">
        <h2 class="text-center mb-4 text-light">⚡ Pembelian Token Listrik</h2>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Cek ketersediaan token --}}
        @if($tokens->isEmpty())
            <div class="alert alert-warning">❗ Tidak ada token tersedia saat ini.</div>
        @else
            {{-- Form Pembelian Token --}}
            <form action="{{ route('user.tokens.purchase') }}" method="POST">
                @csrf

                {{-- Pilih Token --}}
                <div class="mb-3">
                    <label for="token_id" class="form-label text-light">Pilih Token</label>
                    <select name="token_id" id="token_id" class="form-select" required>
                        <option value="">-- Pilih Token --</option>
                        @foreach($tokens as $token)
                            <option value="{{ $token->id }}" @if($token->stok == 0) disabled @endif>
                                {{ $token->nama }} ({{ $token->nominal }} kWh) - Rp{{ number_format($token->harga, 0, ',', '.') }} | Stok: {{ $token->stok }}
                            </option>
                        @endforeach
                    </select>
                    @error('token_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill">
                        🔌 Beli Token Sekarang
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

{{-- Background Bintang Animasi --}}
<div id="stars"></div>

<script>
    const stars = document.getElementById('stars');
    for (let i = 0; i < 60; i++) {
        const s = document.createElement('div');
        s.className = 'star';
        const size = Math.random() * 2 + 1;
        s.style.width = `${size}px`;
        s.style.height = `${size}px`;
        s.style.top = `${Math.random() * 100}vh`;
        s.style.left = `${Math.random() * 100}vw`;
        s.style.opacity = 0.5 + Math.random() * 0.5;
        s.style.animationDuration = `${2 + Math.random() * 2}s`;
        stars.appendChild(s);
    }
</script>
@endsection

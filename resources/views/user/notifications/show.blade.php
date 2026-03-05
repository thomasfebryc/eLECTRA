@extends('layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Card Notifikasi -->
    <div class="card shadow-xl border-0">
        <div class="card-body">
            <h2 class="card-title text-center text-gradient mb-4">{{ $notification->judul }}</h2>
            
            <p class="card-text text-muted mb-3">{{ $notification->konten }}</p>

            <div class="row mb-4">
                <div class="col-12 col-md-6">
                    <p><strong>Mulai pada:</strong> {{ \Carbon\Carbon::parse($notification->mulai_aktif)->format('d F Y H:i') }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <p><strong>Berakhir pada:</strong> {{ \Carbon\Carbon::parse($notification->selesai_aktif)->format('d F Y H:i') }}</p>
                </div>
            </div>

            <!-- Tombol interaktif -->
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-primary btn-lg rounded-pill px-4 py-2 btn-hover">🔥 Buruan ambil!!!</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Card dengan desain premium */
    .card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        padding: 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek hover pada card */
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    /* Gradient untuk judul */
    .card-title {
        font-size: 2.5rem;
        background: linear-gradient(to right, #ff8c00, #e52e71);
        -webkit-background-clip: text;
        color: transparent;
        font-weight: 700;
    }

    /* Teks konten */
    .card-text {
        font-size: 1.1rem;
        color: #4a4a4a;
        line-height: 1.8;
    }

    /* Bagian informasi tanggal */
    .card p {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 12px;
    }

    .text-muted {
        color: #888;
    }

    /* Styling untuk tombol interaktif */
    .btn {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        border: none;
        color: white;
        font-size: 1.1rem;
        padding: 12px 20px;
        border-radius: 50px;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    /* Efek hover pada tombol */
    .btn:hover {
        background: linear-gradient(135deg, #0072ff, #00c6ff);
        transform: translateY(-5px);
    }

    /* Transisi pada tombol */
    .btn:active {
        transform: translateY(2px);
    }

    /* Responsif pada ukuran layar lebih kecil */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 2rem;
        }

        .card-text {
            font-size: 1rem;
        }
    }
</style>
@endsection

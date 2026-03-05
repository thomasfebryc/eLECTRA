C:\xampp\htdocs\laravel-ebs\resources\views\home.blade.php

@extends('layouts.user')

@section('content')
{{-- Logo --}}
<div class="electra-logo text-center my-3">
    <h1 style="...">⚡ eLECTRA</h1>
    <p style="...">Smart Electricity Billing System</p>
</div>

<div class="container my-5">
    <div class="card rounded-4 shadow-lg p-4 glass-effect text-white" style="background: rgba(0,0,0,0.4); backdrop-filter: blur(10px);">
        <h2 class="text-center mb-4">Selamat datang, {{ Auth::user()->name }} 👋</h2>

        <p class="lead text-center">
            <strong>eLECTRA</strong> adalah platform pintar untuk mengelola kebutuhan listrik rumah tangga Anda. Di sini Anda bisa membayar tagihan, membeli token, dan mengakses informasi lengkap tentang penggunaan listrik Anda dengan mudah dan cepat.
        </p>

        {{-- 🔘 Fitur Cepat --}}
        <div class="row justify-content-center my-4">
            <div class="col-md-4 mb-3">
                <a href="{{ route('user.tokens.index') }}" class="btn btn-success btn-lg w-100 rounded-pill shadow">⚡ Beli Token Sekarang</a>
        </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('user.payments') }}" class="btn btn-warning btn-lg w-100 rounded-pill shadow">💳 Bayar Tagihan</a>
            </div>      


        {{-- 🔗 Media Sosial --}}
        <div class="text-center my-4">
            <h5>Ikuti kami di media sosial:</h5>
            <div class="d-flex justify-content-center gap-4 mt-3">
                <a href="https://facebook.com" class="text-white fs-4" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com" class="text-white fs-4" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" class="text-white fs-4" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://t.me" class="text-white fs-4" target="_blank"><i class="fab fa-telegram"></i></a>
            </div>
        </div>

        <div class="text-center mt-5">
            <small>&copy; {{ date('Y') }} eLECTRA - Smart Electricity Experience</small>
        </div>
    </div>
</div>

{{-- Bintang latar belakang --}}
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

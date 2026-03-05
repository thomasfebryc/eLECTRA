@extends('layouts.app')

@section('custom_css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    * { box-sizing: border-box; }

    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(120deg, #1d2b64, #f8cdda, #232526, #414345);
        background-size: 400% 400%;
        animation: gradientBG 18s ease-in-out infinite;
        overflow-x: hidden;
    }

    @keyframes gradientBG {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes twinkle {
        from { opacity: 0.5; }
        to   { opacity: 1; }
    }

    #stars {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        pointer-events: none;
        z-index: 0;
    }

    .star {
        position: absolute;
        background: white;
        border-radius: 50%;
        animation: twinkle 2s infinite alternate;
    }

main {
    min-height: unset;
    margin-top: 5px;
    margin-bottom: 100px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    position: relative;
    z-index: 1;
    padding: 20px;
}


    .glass-card {
        background: rgba(30, 30, 40, 0.85);
        backdrop-filter: blur(16px);
        border-radius: 24px;
        padding: 48px;
        max-width: 480px;
        width: 100%;
        color: white;
        box-shadow: 0 8px 32px rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.18);
        animation: fadeInUp 1.5s ease-out;
    }

    .glass-card h3 {
        text-align: center;
        margin-bottom: 28px;
        font-weight: 700;
    }

    .form-control, .input-group-text {
        background-color: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        border-radius: 10px;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .btn-primary {
        background: linear-gradient(to right, #1d2b64, #f8cdda);
        font-weight: bold;
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: linear-gradient(to right, #f8cdda, #1d2b64);
    }

    .form-check-label, .btn-link {
        color: #e0e0e0;
    }

    .help-block strong {
        color: #ff6b6b;
        font-size: 0.9rem;
    }

    .alert-success {
        background-color: rgba(40,167,69,0.85);
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<!-- Lapisan Bintang -->
<div id="stars"></div>

<main>
    <div class="glass-card">
        <h3>Login</h3>

        @if (session('success'))
            <div class="alert alert-success text-center mb-3">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                @error('password') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label">Remember Me</label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Login</button>

            <!-- Forgot Password -->
            <div class="text-center mb-2">
                <a href="{{ route('password.request') }}" class="btn-link">Forgot Your Password?</a>
            </div>

            <!-- Link to Register -->
            <div class="text-center">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="btn-link">Daftar di sini</a>
            </div>
        </form>
    </div>
</main>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Script Bintang -->
<script>
    const starCount = 70;
    const stars = document.getElementById('stars');
    for (let i = 0; i < starCount; i++) {
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

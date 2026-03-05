@extends('layouts.app')

@section('custom_css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    html, body {
        height: 100%;
        margin: 0;
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

    @keyframes twinkle {
        0%, 100% {
            opacity: 0.2;
            transform: translateY(0) scale(1);
        }
        50% {
            opacity: 1;
            transform: translateY(-10px) scale(1.3);
        }
    }

    .stars {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 0;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .stars span {
        position: absolute;
        display: block;
        background: white;
        width: 2px;
        height: 2px;
        border-radius: 50%;
        animation: twinkle 2s infinite ease-in-out;
        opacity: 0.6;
    }

    .form-wrapper {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
    }

    .glass-card {
        background: rgba(30, 30, 40, 0.85);
        backdrop-filter: blur(14px);
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 600px;
        color: white;
        box-shadow: 0 8px 32px rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.18);
        animation: fadeInUp 1.2s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    h2 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 24px;
        font-size: 2rem;
    }

    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
        color: #eee;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 10px;
        color: white;
        padding: 10px 14px;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .form-control::placeholder {
        color: #ccc;
    }

    .form-control:focus {
        background-color: rgba(255,255,255,0.1);
        border-color: #f8cdda;
        box-shadow: none;
    }

    .btn-primary {
        background: linear-gradient(to right, #1d2b64, #f8cdda);
        border: none;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px;
        font-size: 1rem;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: linear-gradient(to right, #f8cdda, #1d2b64);
    }

    .help-block strong {
        color: #ff6b6b;
        font-size: 0.85rem;
    }

    .link {
        text-align: center;
        margin-top: 1rem;
    }

    .link a {
        color: #f8cdda;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .glass-card {
            padding: 24px;
        }
    }
</style>
@endsection

@section('content')
<div class="stars">
    @for ($i = 0; $i < 50; $i++)
        <span style="top:{{ rand(0,100) }}%; left:{{ rand(0,100) }}%; animation-delay:{{ rand(0,10)/10 }}s;"></span>
    @endfor
</div>

<div class="form-wrapper">
    <div class="glass-card">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Your full name" value="{{ old('name') }}" required autofocus>
            @error('name') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror

            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required>
            @error('email') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror

            <label for="customerId" class="form-label">Connection ID</label>
            <input type="text" id="customerId" name="customerId" class="form-control" placeholder="Enter connection ID" required>
            @error('customerId') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror

            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Your address" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
            @error('password') <span class="help-block"><strong>{{ $message }}</strong></span> @enderror

            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" required>

            <button type="submit" class="btn btn-primary w-100 mt-3">Register Now</button>

            <div class="link mt-3">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>
@endsection

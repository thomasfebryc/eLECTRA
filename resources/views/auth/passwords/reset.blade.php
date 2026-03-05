@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header text-center">
                    <h4 class="mb-0">Reset Password</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Input Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Reset -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                Kirim Tautan Reset Password
                            </button>
                        </div>

                        <!-- Kembali ke Login -->
                        <div class="form-group text-center mt-3">
                            <a href="{{ route('login') }}" class="text-muted">Kembali ke Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

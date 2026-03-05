@extends('layouts.electra')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="text-white fw-bold">⚙️ Pengaturan Sistem</h2>
        <p class="text-muted">Atur tarif dasar listrik global untuk seluruh sistem.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            ✅ <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Bungkus kedua kartu dalam satu baris yang terpusat --}}
    <div class="row justify-content-center g-4">
        
        <div class="col-lg-7">
            <div class="card glass-card shadow">
                <div class="card-header bg-gradient bg-secondary text-white fw-semibold">
                    💡 Pengaturan Tarif Listrik
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tarif" class="form-label">Tarif Dasar Listrik (Rp/kWh)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="tarif" name="tarif" value="{{ $tarif }}" required>
                            </div>
                        </div>

                        {{-- Tambahkan pengaturan lainnya di bawah ini jika diperlukan --}}

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                💾 Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card glass-card shadow border-0 h-100">
                <div class="card-header bg-info text-white fw-semibold">
                    🔌 Tarif Listrik Saat Ini
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <div>
                        <h1 class="text-primary display-5 fw-bold mb-0">
                            Rp {{ number_format(\App\Models\Setting::get('tarif_listrik', 1500), 2, ',', '.') }}
                        </h1>
                        <p class="text-muted mt-2 mb-4">Tarif dasar listrik saat ini (Rp / kWh)</p>
                        <a href="{{ route('admin.settings') }}" class="btn btn-outline-info btn-sm">
                            ⚙️ Atur Ulang
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
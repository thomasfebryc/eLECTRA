@extends('layouts.electra')

@section('title', 'Tambah Notifikasi')

@section('content')
<div class="container">
    <h2 class="mb-4">+ Tambah Notifikasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Notifikasi</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Pesan / Konten</label>
            <textarea name="konten" class="form-control" rows="4" required>{{ old('konten') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Notifikasi</label>
            <select name="tipe" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="promo" {{ old('tipe') == 'promo' ? 'selected' : '' }}>Promo</option>
                <option value="informasi" {{ old('tipe') == 'informasi' ? 'selected' : '' }}>Informasi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mulai_aktif" class="form-label">Mulai Aktif (Opsional)</label>
            <input type="date" name="mulai_aktif" class="form-control" value="{{ old('mulai_aktif') }}">
        </div>

        <div class="mb-3">
            <label for="selesai_aktif" class="form-label">Selesai Aktif (Opsional)</label>
            <input type="date" name="selesai_aktif" class="form-control" value="{{ old('selesai_aktif') }}">
        </div>

        <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">← Kembali</a>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
    </form>
</div>
@endsection

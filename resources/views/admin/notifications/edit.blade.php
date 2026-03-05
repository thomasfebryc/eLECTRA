@extends('layouts.electra')

@section('title', 'Edit Notifikasi')

@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Edit Notifikasi</h2>

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

    <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Notifikasi</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $notification->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Pesan / Konten</label>
            <textarea name="konten" class="form-control" rows="4" required>{{ old('konten', $notification->konten) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Notifikasi</label>
            <select name="tipe" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="promo" {{ old('tipe', $notification->tipe) == 'promo' ? 'selected' : '' }}>Promo</option>
                <option value="informasi" {{ old('tipe', $notification->tipe) == 'informasi' ? 'selected' : '' }}>Informasi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mulai_aktif" class="form-label">Mulai Aktif (Opsional)</label>
            <input type="date" name="mulai_aktif" class="form-control" value="{{ old('mulai_aktif', optional($notification->mulai_aktif)->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="selesai_aktif" class="form-label">Selesai Aktif (Opsional)</label>
            <input type="date" name="selesai_aktif" class="form-control" value="{{ old('selesai_aktif', optional($notification->selesai_aktif)->format('Y-m-d')) }}">
        </div>

        <a href="{{ route('admin.notifications') }}" class="btn btn-secondary">← Batal</a>
        <button type="submit" class="btn btn-success">💾 Perbarui</button>
    </form>
</div>
@endsection

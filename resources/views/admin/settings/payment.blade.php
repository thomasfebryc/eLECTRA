@extends('layouts.electra')

@section('title', 'Pengaturan Pembayaran')

@section('content')
<div class="container">
    <h2 class="mb-4">⚙️ Pengaturan Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.payment.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-select" required>
                <option value="transfer_bank" {{ old('metode', $setting->metode ?? '') == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="qris" {{ old('metode', $setting->metode ?? '') == 'qris' ? 'selected' : '' }}>QRIS</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="form-control" value="{{ old('nama_penerima', $setting->nama_penerima ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <input type="text" name="nomor_tujuan" class="form-control" value="{{ old('nomor_tujuan', $setting->nomor_tujuan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bank</label>
            <input type="text" name="nama_bank" class="form-control" value="{{ old('nama_bank', $setting->nama_bank ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan</button>
    </form>
</div>
@endsection

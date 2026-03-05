@extends('layouts.electra')

@section('title', 'Tambah Token Listrik')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Token Listrik</h2>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tokens.store') }}" method="POST">
        @csrf

        <div class="mb-3">
           <label for="nama">Nama Token</label>
           <input id="nama" name="nama" type="text" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal (kWh)</label>
            <input type="number" step="0.01" name="nominal" id="nominal" class="form-control" value="{{ old('nominal') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" step="0.01" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.tokens.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

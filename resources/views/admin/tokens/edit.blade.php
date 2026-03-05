@extends('layouts.electra')

@section('title', 'Edit Token Listrik')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Token: {{ $token->nama }}</h2>

    <form action="{{ route('admin.tokens.update', $token->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Token</label>
            <input type="text" name="nama" class="form-control" value="{{ $token->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" value="{{ $token->nominal }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $token->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $token->stok }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.tokens.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

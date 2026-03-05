@extends('layouts.electra')

@section('title', 'Manajemen Token Listrik')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Token Listrik</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.tokens.create') }}" class="btn btn-success mb-3">➕ Tambah Token</a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Token</th>
                <th>Nominal (kWh)</th>
                <th>Harga (Rp)</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tokens as $token)
            <tr>
                <td>{{ $token->id }}</td>
                <td>{{ $token->nama }}</td>
                <td>{{ $token->nominal }}</td>
                <td>Rp {{ number_format($token->harga, 0, ',', '.') }}</td>
                <td>{{ $token->stok }}</td>
                <td>
                    <a href="{{ route('admin.tokens.edit', $token->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                    <form action="{{ route('admin.tokens.destroy', $token->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus token ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada token tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.electra')

@section('title', 'Notifikasi & Promo')

@section('content')
<div class="container">
    <h2 class="mb-4">🔔 Notifikasi & Promo</h2>

    {{-- Tombol Tambah --}}
    <a href="{{ route('notifications.create') }}" class="btn btn-primary mb-3">+ Tambah Notifikasi</a>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Daftar Notifikasi --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            Riwayat Notifikasi
        </div>
        <div class="card-body p-0">
            @if($notifications->count())
                <ul class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->judul }}</strong><br>
                            <small class="text-muted">{{ $notification->created_at->format('d M Y H:i') }}</small><br>
                            {{ $notification->pesan }}
                        </div>
                        <div>
                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
    <form action="{{ route('admin.notifications') }}/{{ $notification->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
    </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="p-3 text-center text-muted">Belum ada notifikasi.</div>
            @endif
        </div>
    </div>
</div>
@endsection

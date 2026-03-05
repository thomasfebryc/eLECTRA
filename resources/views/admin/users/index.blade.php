@extends('layouts.electra')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container py-4">
    <h2 class="text-white mb-4">Daftar Pengguna</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Pengguna --}}
    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            <table class="table table-dark table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role === 'admin')
                                <span class="badge bg-info text-dark">Admin</span>
                            @else
                                <span class="badge bg-light text-dark">User</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">

                            {{-- Tombol promote --}}
                            @if ($user->role !== 'admin')
                                <form method="POST" action="{{ route('admin.users.promote', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Jadikan Admin</button>
                                </form>
                            @endif

                            {{-- Tombol hapus --}}
                            @if ($user->role !== 'admin')
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

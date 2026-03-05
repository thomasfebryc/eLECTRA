@extends('layouts.user')

@section('title', 'Tagihan Saya')

@section('content')
<div class="container">
    <h2 class="mb-4">🔌 Daftar Tagihan Listrik</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel tagihan --}}
    <div class="card bg-dark text-white border-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-dark table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Meter Awal</th>
                            <th>Meter Akhir</th>
                            <th>kWh Digunakan</th>
                            <th>Jumlah (Rp)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                            <tr>
                                <td>{{ $bill->month }}</td>
                                <td>{{ $bill->year }}</td>
                                <td>{{ $bill->initial }}</td>
                                <td>{{ $bill->final }}</td>
                                <td>{{ $bill->units }}</td>
                                <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($bill->status === 'Unpaid')
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    @else
                                        <span class="badge bg-success">Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada tagihan tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

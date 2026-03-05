@extends('layouts.user')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="container">
    <h3 class="mb-4">📜 Riwayat Pembayaran</h3>

    @if ($bills->isEmpty())
        <div class="alert alert-info">Belum ada riwayat tagihan yang tersedia.</div>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped">
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
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->month }}</td>
                            <td>{{ $bill->year }}</td>
                            <td>{{ $bill->initial }}</td>
                            <td>{{ $bill->final }}</td>
                            <td>{{ $bill->units }}</td>
                            <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td>
                                @if($bill->status === 'Paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Dibayar</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

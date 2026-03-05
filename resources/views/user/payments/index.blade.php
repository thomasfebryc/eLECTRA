@extends('layouts.user')

@section('title', 'Pembayaran Tagihan')

@section('content')
<div class="container">
    <h3 class="mb-4">💳 Pembayaran Tagihan</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($unpaidBills->isEmpty())
        <div class="alert alert-info">🎉 Anda tidak memiliki tagihan yang belum dibayar.</div>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Bulan</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Jumlah (Rp)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unpaidBills as $bill)
                        <tr>
                            <td>{{ $bill->month }}</td>
                            <td>{{ $bill->year }}</td>
                            <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ $bill->status }}</span>
                            </td>
                            <td>
                                <form action="{{ route('user.pay', $bill->id) }}" method="POST" onsubmit="return confirm('Bayar tagihan ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        💰 Bayar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

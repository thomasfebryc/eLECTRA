@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Cetak Invoice</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('user.invoice.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="month">Bulan:</label>
            <select name="month" id="month" class="form-control" required>
                <option value="">-- Pilih Bulan --</option>
                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                    <option value="{{ $bulan }}">{{ $bulan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="year">Tahun:</label>
            <input type="number" name="year" id="year" class="form-control" min="2020" max="{{ date('Y') }}" value="{{ date('Y') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Cetak Invoice</button>
    </form>
</div>
@endsection

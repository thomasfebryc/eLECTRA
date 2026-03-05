@extends('layouts.user')

@section('title', 'Cetak Invoice')

@section('content')
<div class="container">
    <h3 class="mb-4">📄 Cetak Invoice</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('user.invoice.generate') }}" method="POST" target="_blank">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="month">Bulan</label>
                <select name="month" id="month" class="form-select">
                    @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                        <option value="{{ $bln }}">{{ $bln }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="year">Tahun</label>
                <select name="year" id="year" class="form-select">
                    @for ($i = date('Y') - 5; $i <= date('Y') + 1; $i++)
                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        <a href="{{ route('user.invoice', ['id' => $token->id]) }}" class="btn btn-sm btn-primary">
           🧾 Download Invoice
        </a>           
        </div>
    </form>
</div>
@endsection

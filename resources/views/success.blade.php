@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
            <div class="alert alert-success text-center shadow-sm rounded">
                <h3 class="mb-4">Data Berhasil Ditambahkan!</h3>
                <a href="{{ url('/admin') }}" class="btn btn-success px-4 rounded-0">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
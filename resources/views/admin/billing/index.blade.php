@extends('layouts.electra')
@section('title', '📥 Pengelolaan Tagihan Listrik')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-white mb-5 fw-bold">📥 Pengelolaan Tagihan Listrik</h2>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    {{-- Baris ini diubah untuk memusatkan konten di dalamnya --}}
    <div class="row g-4 justify-content-center"> 
        <div class="col-lg-6">
            <div class="card glass-card shadow border-0">
                <div class="card-header bg-primary text-white fw-semibold">+ Tambah Tagihan Baru</div>
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="user_id" class="form-label">🔍 Pilih Pelanggan</label>
                            <select id="user_id" name="user_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih ID Pelanggan --</option>
                                @foreach (\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->customerId }} - {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="initial" class="form-label">📟 Meter Awal</label>
                            <input type="number" class="form-control" id="initial" name="initial" required>
                        </div>

                        <div class="mb-3">
                            <label for="final" class="form-label">📟 Meter Akhir</label>
                            <input type="number" class="form-control" id="final" name="final" required>
                        </div>

                        <div class="mb-3">
                            <label for="month" class="form-label">🗓️ Bulan</label>
                            <select id="month" name="month" class="form-select" required>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                                    <option value="{{ $bln }}">{{ $bln }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">📅 Tahun</label>
                            <select id="year" name="year" class="form-select" required>
                                @for ($i = date('Y') - 10; $i <= date('Y') + 5; $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            💾 Simpan Tagihan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card glass-card shadow border-0 mt-5">
        <div class="card-header bg-dark text-white fw-semibold">📋 Riwayat Tagihan Listrik</div>
        <div class="card-body table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Meter Awal</th>
                        <th scope="col">Meter Akhir</th>
                        <th scope="col">kWh</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->user->name }} ({{ $bill->user->customerId }})</td>
                            <td>{{ $bill->month }} {{ $bill->year }}</td>
                            <td>{{ $bill->initial }}</td>
                            <td>{{ $bill->final }}</td>
                            <td>{{ $bill->units }} kWh</td>
                            <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td>
                                @if ($bill->status === 'Paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                                @endif
                            </td>
                            <td>{{ $bill->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Efek Bintang --}}
<div id="stars"></div>
<script>
    const stars = document.getElementById('stars');
    for (let i = 0; i < 60; i++) {
        const s = document.createElement('div');
        s.className = 'star';
        const size = Math.random() * 2 + 1;
        s.style.width = `${size}px`;
        s.style.height = `${size}px`;
        s.style.top = `${Math.random() * 100}vh`;
        s.style.left = `${Math.random() * 100}vw`;
        s.style.opacity = 0.5 + Math.random() * 0.5;
        s.style.animationDuration = `${2 + Math.random() * 2}s`;
        stars.appendChild(s);
    }
</script>
@endsection
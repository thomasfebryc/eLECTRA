@extends('layouts.electra')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    <h2 class="text-white text-center mb-4">Selamat datang, {{ Auth::user()->name }} 👋</h2>

    <div class="row text-white mb-4">
        <div class="col-md-6">
            <div class="card bg-success glass-card">
                <div class="card-body">
                    <h5>Total Pengguna</h5>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-info glass-card">
                <div class="card-body">
                    <h5>Admin Aktif</h5>
                    <h3>{{ $totalAdmins }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="card glass-card text-white">
        <div class="card-header bg-dark">Grafik Penjualan</div>
        <div class="card-body">
            @if($transactions->count())
                <canvas id="salesChart"></canvas>
            @else
                <p class="text-center text-muted">Belum ada data transaksi untuk ditampilkan.</p>
            @endif
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const transactions = {!! json_encode($transactions) !!};

    if (transactions.length > 0) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: transactions.map(t => t.date),
                datasets: [{
                    label: 'Total Penjualan',
                    data: transactions.map(t => t.total),
                    borderColor: '#f8cdda',
                    backgroundColor: 'rgba(248, 205, 218, 0.3)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });
    }
</script>
@endsection

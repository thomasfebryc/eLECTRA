<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>

    <p><strong>Total Transaksi:</strong> {{ $totalTransaksi }}</p>
    <p><strong>Total Pemasukan:</strong> Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
    <p><strong>Total Token Terjual:</strong> {{ $totalTokenTerjual }} kWh</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Token</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tx->user->name ?? '-' }}</td>
                <td>{{ $tx->token->nama ?? '-' }}</td>
                <td>{{ $tx->jumlah }}</td>
                <td>Rp{{ number_format($tx->total_harga, 0, ',', '.') }}</td>
                <td>{{ $tx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

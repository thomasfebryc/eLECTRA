<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Tagihan - ID {{ $bill->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 60px;
        }

        .info, .details {
            margin-bottom: 20px;
        }

        .info p, .details p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th {
            background-color: #f8f8f8;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="logo">
            <img src="{{ public_path('images/Electra.png') }}" alt="Logo Electra">
        </div>
        <h2>Invoice Tagihan Listrik</h2>

        <div class="info">
            <p><strong>Nama Pengguna:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Bulan:</strong> {{ $bill->month }} {{ $bill->year }}</p>
            <p><strong>Invoice ID:</strong> INV-{{ $bill->id }}-{{ now()->format('His') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Meter Awal</th>
                    <th>Meter Akhir</th>
                    <th>Pemakaian (kWh)</th>
                    <th>Total Tagihan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $bill->initial }}</td>
                    <td>{{ $bill->final }}</td>
                    <td>{{ $bill->units }}</td>
                    <td>Rp{{ number_format($bill->amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($bill->status) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Terima kasih telah menggunakan layanan kami.  
            <br>&copy; {{ now()->year }} Laravel-EBS — Invoice ini dibuat secara otomatis.
        </div>
    </div>
</body>
</html>

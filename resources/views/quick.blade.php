<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Pembayaran Listrik</title>
  <style>
    body {
      font-family: Raleway, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: white;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1, h2, h3 {
      text-align: center;
    }
    label {
      display: block;
      margin-top: 15px;
    }
    input[type="text"], input[type="email"], input[type="number"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
    }
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
    }
    .radio-group {
      margin-top: 10px;
    }
    .radio-group label {
      display: inline-block;
      margin-right: 20px;
    }
    .terms {
      margin-top: 20px;
    }
    .btn-submit {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background: #007BFF;
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
    .btn-submit:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Formulir Pembayaran Listrik</h1>
  <p><strong>ID Pelanggan:</strong> {{ Auth::user()->customerId }}</p>
  <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
  <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
  <p><strong>Alamat:</strong> {{ Auth::user()->address }}</p>
  <p><strong>Bulan Tagihan:</strong> <span style="color:red">{{$data[0]->month}}, {{$data[0]->year}}</span></p>

  <h3>Detail Tagihan</h3>
  <table border="1" width="100%" cellspacing="0" cellpadding="10">
    <tr>
      <th>Meter Awal</th>
      <th>Meter Akhir</th>
      <th>Jumlah KWh</th>
      <th>Tarif per kWh</th>
      <th>Total Bayar</th>
    </tr>
    <tr>
      <td>{{ $data[0]->initial }}</td>
      <td>{{ $data[0]->final }}</td>
      <td>{{ $data[0]->units }}</td>
      <td>Rp {{ number_format(($data[0]->amount)/($data[0]->units), 2, ',', '.') }}</td>
      <td><strong style="color:red;">Rp {{ number_format($data[0]->amount, 2, ',', '.') }}</strong></td>
    </tr>
  </table>

  <form action="/home/pay" method="POST">
    @csrf
    <h3>Pilih Metode Pembayaran</h3>
    <div class="radio-group">
      <label><input type="radio" name="payment_method" value="transfer" checked> Transfer Bank</label>
      <label><input type="radio" name="payment_method" value="qris"> QRIS</label>
      <label><input type="radio" name="payment_method" value="ewallet"> E-Wallet</label>
    </div>

    <label for="bank">Pilih Bank</label>
    <select name="bank" id="bank">
      <option value="bca">BCA</option>
      <option value="bni">BNI</option>
      <option value="bri">BRI</option>
      <option value="mandiri">Mandiri</option>
      <option value="cimb">CIMB Niaga</option>
    </select>

    <label for="card_number">Nomor Kartu / Rekening</label>
    <input type="text" name="card_number" required>

    <label for="name">Nama Pemilik Rekening</label>
    <input type="text" name="name" required>

    <label for="email">Email Konfirmasi</label>
    <input type="email" name="email" required>

    <div class="terms">
      <input type="checkbox" id="agree" required>
      <label for="agree">Saya menyetujui syarat & ketentuan yang berlaku.</label>
    </div>

    <button type="submit" class="btn-submit">Bayar Sekarang</button>
  </form>
</div>

</body>
</html>

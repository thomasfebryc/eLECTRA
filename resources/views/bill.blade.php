<!DOCTYPE html>
<html>
<head>
	<title>Tagihan Listrik</title>
	<style>
		body {
			font-family: Raleway, sans-serif;
		}
		.right {
			float: right;
		}
		.red {
			color: red;
		}
		.tg {
			border-collapse: collapse;
			border-spacing: 0;
			margin: auto;
		}
		.tg td {
			font-family: Arial, sans-serif;
			font-size: 14px;
			padding: 4px 20px;
			border-style: solid;
			border-width: 1px;
			overflow: hidden;
			word-break: normal;
		}
		.tg th {
			font-family: Arial, sans-serif;
			font-size: 14px;
			font-weight: normal;
			padding: 4px 20px;
			border-style: solid;
			border-width: 1px;
			overflow: hidden;
			word-break: normal;
		}
		.tg .tg-yw4l {
			vertical-align: top;
		}
	</style>
</head>
<body>
	<h1><center>Sistem Tagihan Listrik Online</center></h1>
	<hr>
	<br><br>

	<div><strong>ID Pelanggan: </strong>{{ Auth::user()->customerId }}</div>
	<div><strong>Nama: </strong>{{ Auth::user()->name }}</div>
	<div><strong>Email: </strong>{{ Auth::user()->email }}</div>
	<div><strong>Alamat Penagihan: </strong>{{ Auth::user()->address }}</div>
	<div><strong>Tagihan untuk Bulan: </strong><span class="red">{{ $data[0]->month }}, {{ $data[0]->year }}</span></div>

	<br><br>

	<table class="tg">
		<tr>
			<th class="tg-yw4l">Meter Awal</th>
			<th class="tg-yw4l">Meter Akhir</th>
			<th class="tg-yw4l">Total Pemakaian (kWh)</th>
			<th class="tg-yw4l">Tarif per kWh</th>
			<th class="tg-yw4l">Total Bayar</th>
		</tr>
		<tr>
			<td class="tg-yw4l">{{ $data[0]->initial }}</td>
			<td class="tg-yw4l">{{ $data[0]->final }}</td>
			<td class="tg-yw4l">{{ $data[0]->units }}</td>
			<td class="tg-yw4l">Rp {{ number_format(($data[0]->amount)/($data[0]->units), 2, ',', '.') }} / kWh</td>
			<td class="tg-yw4l red"><strong>Rp {{ number_format($data[0]->amount, 2, ',', '.') }}</strong></td>
		</tr>
	</table>

	<br>
</body>
</html>

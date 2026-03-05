<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        // Bisa ditambahkan filter tanggal nanti
        $transactions = Transaction::with(['user', 'token'])->latest()->get();

        $totalTransaksi = $transactions->count();
        $totalPemasukan = $transactions->sum('total_harga');
        $totalTokenTerjual = $transactions->sum('jumlah');

        return view('admin.reports.index', compact(
            'transactions',
            'totalTransaksi',
            'totalPemasukan',
            'totalTokenTerjual'
        ));
    }

    public function exportPdf()
{
    $transactions = \App\Models\Transaction::with(['user', 'token'])->latest()->get();

    $totalTransaksi = $transactions->count();
    $totalPemasukan = $transactions->sum('total_harga');
    $totalTokenTerjual = $transactions->sum('jumlah');

    $pdf = PDF::loadView('admin.reports.pdf', compact(
        'transactions',
        'totalTransaksi',
        'totalPemasukan',
        'totalTokenTerjual'
    ));

    return $pdf->download('laporan_transaksi.pdf');
}
}

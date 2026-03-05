<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use PDF;
use App\Models\Bill;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Tampilkan semua transaksi dengan filter opsional.
     */
public function index(Request $request)
{
    $query = Transaction::with(['user', 'token'])->latest();

    // Filter transaksi token
    if ($request->user) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->user . '%');
        });
    }

    if ($request->tanggal) {
        $query->whereDate('created_at', $request->tanggal);
    }

    $transactions = $query->get();

    // Ambil semua tagihan listrik yang sudah dibayar
    $bills = Bill::with('user')->where('status', 'Paid')->latest()->get();

    // Kirim ke view
    return view('admin.transactions.index', compact('transactions', 'bills'));
}


    /**
     * Export transaksi ke PDF sesuai filter.
     */
    public function exportPdf(Request $request)
    {
        $query = Transaction::with(['user', 'token'])->latest();

        // Filter berdasarkan nama user
        if ($request->user) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $transactions = $query->get();

        $pdf = PDF::loadView('admin.transactions.pdf', compact('transactions'));
        return $pdf->download('riwayat_transaksi.pdf');
    }

    public function markPaid($id)
{
    $transaction = \App\Models\Transaction::findOrFail($id);
    $transaction->status = 'paid';
    $transaction->save();

    return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil ditandai sebagai sudah dibayar.');
}

public function confirm($id)
{
    $transaction = Transaction::findOrFail($id);

    if (!$transaction->confirmation) {
        return back()->with('error', 'Transaksi belum memiliki bukti konfirmasi.');
    }

    $transaction->status = 'lunas';
    $transaction->save();

    return back()->with('success', 'Transaksi ditandai sebagai lunas.');
}

public function destroy($id)
{
    $transaction = Transaction::findOrFail($id);

    // Hapus juga relasi confirmation jika ada
    if ($transaction->confirmation) {
        $transaction->confirmation->delete();
    }

    $transaction->delete();

    return redirect()->route('admin.transactions.index')
        ->with('success', 'Transaksi berhasil dihapus.');
}



}

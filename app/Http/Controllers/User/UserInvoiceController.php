<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bill;
use PDF;

class UserInvoiceController extends Controller
{
    // Tampilkan form pilih bulan/tahun
    public function form()
    {
        return view('user.invoice.form');
    }

    // Generate PDF invoice berdasarkan bulan dan tahun
    public function generate(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $user = Auth::user();

        // Ambil semua tagihan user di bulan dan tahun tersebut
        $bills = Bill::where('user_id', $user->id)
                    ->where('month', $month)
                    ->where('year', $year)
                    ->get();

        if ($bills->isEmpty()) {
            return back()->with('error', 'Tidak ada data tagihan pada bulan dan tahun tersebut.');
        }

        $pdf = PDF::loadView('user.invoice.generate', compact('bills', 'user', 'month', 'year'));

        return $pdf->stream('invoice-' . $month . '-' . $year . '.pdf');
    }

    // Download invoice PDF berdasarkan ID
    public function download($id)
    {
        $bill = Bill::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $user = Auth::user();

        $pdf = PDF::loadView('user.invoice.pdf', compact('bill', 'user'));

        return $pdf->download('invoice-tagihan-' . $bill->id . '.pdf');
    }
}

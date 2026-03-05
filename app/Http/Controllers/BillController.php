<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bill;
use App\Models\User;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Semua fungsi butuh login
    }

    // ========== UNTUK USER ==========

    public function showUnpaid()
    {
        $bills = Bill::where('user_id', Auth::id())
                     ->where('status', 'Unpaid')
                     ->get();

        return view('user.payments.index', ['unpaidBills' => $bills]);
    }

    public function payBill($id)
    {
        $bill = Bill::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->where('status', 'Unpaid')
                    ->firstOrFail();

        $bill->status = 'Paid';
        $bill->save();

        return redirect()->route('user.payments')->with('success', 'Tagihan berhasil dibayar!');
    }

    public function history()
    {
        $bills = Bill::where('user_id', Auth::id())
                    ->orderByDesc('year')
                    ->orderByDesc('month')
                    ->get();

        return view('user.history.index', compact('bills'));
    }

    public function invoiceForm()
    {
        return view('user.invoice.index');
    }

    public function generateInvoicePDF(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required|numeric',
        ]);

        $bill = Bill::where('user_id', Auth::id())
                    ->where('month', $request->month)
                    ->where('year', $request->year)
                    ->first();

        if (!$bill) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan untuk bulan dan tahun tersebut.');
        }

        $pdf = Pdf::loadView('user.invoice.pdf', compact('bill'));
        return $pdf->stream("invoice-{$bill->month}-{$bill->year}.pdf");
    }

    // ========== UNTUK ADMIN ==========
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'initial' => 'required|numeric|min:0',
            'final' => 'required|numeric|gte:initial',
            'month' => 'required|string',
            'year' => 'required|numeric',
        ]);

        $user = User::findOrFail($request->user_id);
        $kwhUsed = $request->final - $request->initial;

        $tarif = Setting::get('tarif_listrik', 1500); // default 1500 jika tidak ada setting
        $total = $kwhUsed * $tarif;

        Bill::create([
            'user_id' => $user->id,
            'customerId'  => $user->customerId,
            'initial' => $request->initial,
            'final' => $request->final,
            'month' => $request->month,
            'year' => $request->year,
            'units' => $kwhUsed,
            'amount' => $total,
            'status' => 'unpaid',
        ]);

        return redirect()->back()->with('success', 'Tagihan berhasil ditambahkan.');
    }

    public function updaterate(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'rate' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->rate = $request->rate;
        $user->save();

        return redirect()->back()->with('success', 'Tarif pribadi berhasil diperbarui.');
    }

    // Fungsi pembantu: pastikan admin
    protected function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'main_admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
    }

    // Menampilkan semua tagihan ke admin
public function index()
{
    $this->authorizeAdmin(); // Cek admin

    $bills = Bill::with('user')->orderByDesc('created_at')->get();

    return view('admin.billing.index', compact('bills'));
}
}

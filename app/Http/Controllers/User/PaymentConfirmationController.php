<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Confirmation;
use Illuminate\Support\Facades\Storage;

class PaymentConfirmationController extends Controller
{
    // Menampilkan form konfirmasi pembayaran
    public function create(Transaction $transaction)
    {
        return view('user.tokens.confirm', compact('transaction'));
    }

    // Menyimpan data konfirmasi pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan'        => 'nullable|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        Confirmation::create([
            'transaction_id' => $transaction->id,
            'bukti_transfer' => $path,
            'catatan'        => $request->catatan,
        ]);

        if ($transaction->status === 'pending') {
            $transaction->status = 'menunggu_verifikasi';
            $transaction->save();
        }

        return redirect()->route('user.tokens.index')->with('success', 'Konfirmasi pembayaran berhasil dikirim.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Transaction;
use App\Models\PaymentSetting;
use App\Models\Confirmation;
use Illuminate\Support\Facades\Storage;

class TokenUserController extends Controller
{
    public function index()
    {
        // Tampilkan daftar token yang masih tersedia
        $tokens = Token::where('stok', '>', 0)->get();
        return view('user.tokens.index', compact('tokens'));
    }

    public function buy()
    {
        // Tampilkan halaman pembelian token
        $tokens = Token::where('stok', '>', 0)->get();
        return view('user.tokens.buy', compact('tokens'));
    }

    public function purchase(Request $request)
    {
        // Validasi token yang dipilih
        $request->validate([
            'token_id' => 'required|exists:tokens,id',
        ]);

        // Ambil token berdasarkan ID yang dipilih
        $token = Token::findOrFail($request->token_id);

        // Periksa jika stok token habis
        if ($token->stok < 1) {
            return back()->with('error', 'Stok token habis.');
        }

        // Kurangi stok token setelah dipilih
        $token->decrement('stok');

        // Simpan transaksi baru
        $transaction = Transaction::create([
            'user_id'     => auth()->id(),
            'token_id'    => $token->id,
            'jumlah'      => $token->nominal ?? 1,
            'total_harga' => $token->harga,
            'status'      => 'pending',
        ]);

        // Ambil data pembayaran dari tabel PaymentSetting
        $setting = PaymentSetting::first();
        
        $payment = [
            'metode'         => $setting->metode ?? 'transfer_bank',
            'nama_penerima'  => $setting->nama_penerima ?? 'Admin EBS',
            'nomor_tujuan'   => $setting->nomor_tujuan ?? '0000000000',
            'nama_bank'      => $setting->nama_bank ?? '-',
        ];

        // Mengirimkan data transaksi, token, dan pembayaran ke halaman payment.blade.php
        return view('user.tokens.payment', compact('transaction', 'payment', 'token'));
    }

    public function confirmPayment($id)
    {
        // Hanya izinkan konfirmasi jika transaksi masih pending
        $transaction = Transaction::where('id', $id)
                                  ->where('user_id', auth()->id())
                                  ->firstOrFail();

        if ($transaction->status === 'pending') {
            // Mengubah status transaksi menjadi 'menunggu_verifikasi'
            $transaction->status = 'menunggu_verifikasi';
            $transaction->save();

            // Mengarahkan pengguna ke halaman konfirmasi pembayaran
            return redirect()->route('user.tokens.confirm.form', ['transaction' => $transaction->id])
                             ->with('success', 'Konfirmasi pembayaran berhasil dikirim.');
        }

        return back()->with('error', 'Transaksi tidak valid.');
    }

    public function confirm(Request $request)
    {
        // Validasi form konfirmasi pembayaran
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan'        => 'nullable|string|max:500',
        ]);

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($request->transaction_id);

        // Pastikan transaksi milik pengguna yang sedang login
        if ($transaction->user_id !== auth()->id()) {
            return redirect()->route('user.tokens.index')->with('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Upload dan simpan bukti transfer ke penyimpanan publik
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Simpan data konfirmasi ke database
        Confirmation::create([
            'transaction_id' => $transaction->id,
            'bukti_transfer' => $path,
            'catatan'        => $request->catatan,
        ]);

        // Update status transaksi menjadi 'menunggu_verifikasi'
        $transaction->status = 'menunggu_verifikasi';
        $transaction->save();

        return redirect()->route('user.tokens.index')
                         ->with('success', 'Konfirmasi pembayaran berhasil dikirim.');
    }

    public function showConfirmForm(Transaction $transaction)
    {
        // Pastikan transaksi yang ditampilkan milik pengguna yang sedang login
        if ($transaction->user_id !== auth()->id()) {
            return redirect()->route('user.tokens.index')->with('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Mengirimkan data transaksi ke view untuk ditampilkan
        return view('user.tokens.confirm', compact('transaction'));
    }
}

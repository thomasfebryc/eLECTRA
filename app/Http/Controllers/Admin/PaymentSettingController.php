<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class PaymentSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Tampilkan form pengaturan pembayaran.
     */
    public function index()
    {
        $setting = (object) [
            'metode'         => Setting::get('metode'),
            'nama_bank'      => Setting::get('nama_bank'),
            'nomor_tujuan'   => Setting::get('nomor_tujuan'),
            'nama_penerima'  => Setting::get('nama_penerima'),
        ];

        return view('admin.settings.payment', compact('setting'));
    }

    /**
     * Simpan atau perbarui pengaturan pembayaran.
     */
    public function update(Request $request)
    {
        $request->validate([
            'metode'         => 'required|string',
            'nama_bank'      => 'required|string|max:100',
            'nomor_tujuan'   => 'required|string|max:50',
            'nama_penerima'  => 'required|string|max:100',
        ]);

        Setting::set('metode', $request->metode);
        Setting::set('nama_bank', $request->nama_bank);
        Setting::set('nomor_tujuan', $request->nomor_tujuan);
        Setting::set('nama_penerima', $request->nama_penerima);

        return redirect()->route('admin.settings.payment')->with('success', 'Pengaturan pembayaran diperbarui.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $tarif = Setting::get('tarif_listrik', 1500); // ambil tarif global (default 1500)
        return view('admin.settings.index', compact('tarif'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tarif' => 'required|numeric|min:0',
        ]);

        Setting::set('tarif_listrik', $request->tarif);

        return back()->with('success', 'Tarif berhasil diperbarui.');
    }
}

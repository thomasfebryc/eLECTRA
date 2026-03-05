<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Tampilkan daftar semua notifikasi/promo.
     */
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Tampilkan form untuk membuat notifikasi baru.
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Simpan notifikasi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:promo,informasi',
            'mulai_aktif' => 'nullable|date',
            'selesai_aktif' => 'nullable|date|after_or_equal:mulai_aktif',
        ]);

        Notification::create($request->all());

        return redirect()->route('admin.notifications')
            ->with('success', 'Notifikasi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit notifikasi.
     */
public function edit($id)
{
    $notification = Notification::findOrFail($id);
    return view('admin.notifications.edit', compact('notification'));
}

    /**
     * Perbarui data notifikasi.
     */
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:promo,informasi',
            'mulai_aktif' => 'nullable|date',
            'selesai_aktif' => 'nullable|date|after_or_equal:mulai_aktif',
        ]);

        $notification->update($request->all());

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil diperbarui.');
    }

    /**
     * Hapus notifikasi.
     */
public function destroy($id)
{
    $notification = Notification::findOrFail($id);
    $notification->delete();

    return redirect()->route('admin.notifications')
        ->with('success', 'Notifikasi berhasil dihapus.');
}

// Tambahkan method ini di class NotificationController
public function show($id)
{
    $notification = Notification::findOrFail($id);
    return view('admin.notifications.show', compact('notification'));
}
}

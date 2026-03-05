<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;  // Pastikan mengimpor Str

class NotificationUserController extends Controller
{
    // Method untuk menampilkan daftar notifikasi
    public function index()
    {
        $notifications = Notification::all();  // Mengambil semua notifikasi
        return view('user.notifications.index', compact('notifications'));
    }

    // Method untuk menampilkan detail notifikasi
    public function show($id)
    {
        $notification = Notification::findOrFail($id);  // Mengambil notifikasi berdasarkan ID
        return view('user.notifications.show', compact('notification'));
    }
}

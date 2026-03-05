@extends('layouts.user')

@section('css')
<style>
    /* Styling untuk container utama */
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        border-radius: 8px;
    }

    /* Styling untuk judul halaman */
    h1 {
        font-size: 2rem;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Box untuk notifikasi */
    .notification-box {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Styling untuk daftar notifikasi */
    .notification-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .notification-item {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        padding: 15px;
        transition: background-color 0.3s ease;
    }

    .notification-item:hover {
        background-color: #f1f1f1;
    }

    .notification-link {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .notification-title {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .notification-content {
        font-size: 1rem;
        color: #555;
    }

    /* Box untuk pesan tidak ada notifikasi */
    .no-notifications-box {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .no-notifications {
        font-size: 1.2rem;
        color: #777;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Notifikasi Anda</h1>

    @if($notifications->count())
        <div class="notification-box">
            <ul class="notification-list">
                @foreach($notifications as $notification)
                    <li class="notification-item">
                        <a href="{{ route('user.notifications.show', $notification->id) }}" class="notification-link">
                            <strong class="notification-title">{{ $notification->judul }}</strong><br>
                            <span class="notification-content">{{ Str::limit($notification->konten, 100) }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="no-notifications-box">
            <p class="no-notifications">Anda tidak memiliki notifikasi.</p>
        </div>
    @endif
</div>
@endsection

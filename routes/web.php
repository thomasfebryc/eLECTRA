<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller Import
use App\Http\Controllers\HomeController;
use App\Http\Controllers\billController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\TokenUserController;
use App\Http\Controllers\User\NotificationUserController;
use App\Http\Controllers\User\SettingUserController;
use App\Http\Controllers\User\UserInvoiceController;
use App\Http\Controllers\User\PaymentConfirmationController;

// ==========================
// PUBLIC / GUEST ROUTES
// ==========================
Route::get('/', function () {
    return view('welcome'); // Landing Page
});

// ==========================
// AUTHENTICATION ROUTES
// ==========================
Auth::routes(); // login, register, reset password, etc.

// ==========================
// USER ROUTES (Role: user)
// ==========================
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/pay', [BillController::class, 'user.payments']);
    Route::get('/home/quick', function () {
        return view('quick');
    });
    Route::post('/home/pdf', [BillController::class, 'pdf'])->name('home.pdf');

    // 👤 User Menu

    // ===================
    // 🧾 Tagihan & Invoice
    // ===================
    Route::get('/user/payments', [BillController::class, 'showUnpaid'])->name('user.payments');
    Route::put('/user/payments/{id}', [BillController::class, 'payBill'])->name('user.pay');
    Route::get('/user/history', [BillController::class, 'history'])->name('user.history');

    Route::get('/user/invoice/cetak', [UserInvoiceController::class, 'form'])->name('user.invoice.form');
    Route::post('/user/invoice/generate', [UserInvoiceController::class, 'generate'])->name('user.invoice.generate');
    Route::get('/user/invoice/{id}', [UserInvoiceController::class, 'download'])->name('user.invoice');

// ===================
// ⚡ TOKEN - BENAR (STRUCTURED)
// ===================
// routes/web.php
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/tokens', [TokenUserController::class, 'index'])->name('user.tokens.index'); // Halaman daftar token
    Route::get('/tokens/buy', [TokenUserController::class, 'buy'])->name('user.tokens.buy'); // Halaman pembelian token
    Route::post('/tokens/purchase', [TokenUserController::class, 'purchase'])->name('user.tokens.purchase'); // Pembelian token
    Route::get('/tokens/confirm-payment/{transaction}', [TokenUserController::class, 'showConfirmForm'])->name('user.tokens.confirm.form'); // Form konfirmasi pembayaran
    Route::post('/tokens/confirm-payment', [TokenUserController::class, 'confirm'])->name('user.tokens.confirm'); // Proses konfirmasi pembayaran
    
    //Route::post('/tokens/confirm-payment/{transaction}', [TokenUserController::class, 'confirm'])->name('user.tokens.confirm');

});


    // ===================
    // 🔔 Notifikasi & Pengaturan
    // ===================
    Route::get('notifications', [NotificationUserController::class, 'index'])->name('user.notifications.index');
    Route::get('notifications/{id}', [NotificationUserController::class, 'show'])->name('user.notifications.show');
    Route::get('/user/settings', [SettingUserController::class, 'index'])->name('user.settings');
});

// ==========================
// ADMIN ROUTES (Role: admin)
// ==========================
Route::middleware(['auth', 'admin'])->group(function () {

    // 🧭 Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // 👥 Manajemen Pengguna
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/promote', [AdminController::class, 'promote'])->name('admin.users.promote');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // ⚡ Manajemen Token Listrik
    Route::get('/admin/tokens', [TokenController::class, 'index'])->name('admin.tokens.index');
    Route::get('/admin/tokens/create', [TokenController::class, 'create'])->name('admin.tokens.create');
    Route::post('/admin/tokens', [TokenController::class, 'store'])->name('admin.tokens.store');
    Route::get('/admin/tokens/{token}/edit', [TokenController::class, 'edit'])->name('admin.tokens.edit');
    Route::put('/admin/tokens/{token}', [TokenController::class, 'update'])->name('admin.tokens.update');
    Route::delete('/admin/tokens/{token}', [TokenController::class, 'destroy'])->name('admin.tokens.destroy');

    // 💰 Transaksi
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/admin/transactions/pdf', [TransactionController::class, 'exportPdf'])->name('admin.transactions.pdf');

    // ❌ SALAH: Ini menyebabkan error karena AdminController tidak punya method transactions()
    //Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');

    // 🔔 Notifikasi & Promo
    //Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');

    Route::get('/admin/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/admin/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('/admin/notifications/{id}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::put('/admin/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/admin/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('admin/notifications/{id}', [NotificationController::class, 'show'])->name('admin.notifications.show');

    
    //Route::get('admin/notifications', [NotificationController::class, 'index']);


    // 📄 Laporan
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/reports/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');

    // ⚙️ Pengaturan Sistem
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings/update-tariff', [SettingController::class, 'updateTariff'])->name('admin.settings.updateTariff');

    // 💡 Tambahan (form input & tarif)
    Route::post('/admin/store', [billController::class, 'store'])->name('admin.store');
    Route::post('/admin/updaterate', [billController::class, 'updaterate'])->name('admin.updaterate');

    // 💳 Metode Pembayaran
    Route::get('/admin/settings/payment', [PaymentSettingController::class, 'index'])->name('admin.settings.payment');
    Route::post('/admin/settings/payment', [PaymentSettingController::class, 'update'])->name('admin.settings.payment.update');

    // 💸 Tagihan Admin
    Route::get('/admin/billing', [AdminController::class, 'billing'])->name('admin.billing');

    // 🛡️ Role Management
    Route::post('/admin/roles/assign', [AdminController::class, 'assignRoleToUser'])->name('admin.roles.assign');
    Route::post('/admin/roles/create', [AdminController::class, 'createRole'])->name('admin.roles.create');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/konfirmasi/{id}', [App\Http\Controllers\Admin\ConfirmationController::class, 'show'])->name('admin.confirmations.show');
        Route::post('/admin/transactions/{id}/mark-paid', [TransactionController::class, 'markPaid'])->name('admin.transactions.markPaid');
        Route::patch('/admin/transactions/{id}/confirm', [TransactionController::class, 'confirm'])->name('admin.transactions.confirm');
        Route::delete('/admin/transactions/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');
    });

});

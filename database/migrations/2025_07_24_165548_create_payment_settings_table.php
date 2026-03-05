<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('metode'); // Contoh: Bank Transfer, QRIS, E-Wallet
            $table->string('nama_bank'); // Contoh: BCA, BRI, OVO
            $table->string('nomor_tujuan'); // Nomor rekening atau e-wallet
            $table->string('nama_penerima');
            $table->string('gambar_qris')->nullable(); // Optional QRIS image
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};

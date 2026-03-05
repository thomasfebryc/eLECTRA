<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Sesuaikan dengan tipe user_id = unsigned integer
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('token_id');

            $table->integer('jumlah'); // jumlah kWh
            $table->bigInteger('total_harga');
            $table->timestamps();

            // Foreign key relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('token_id')->references('id')->on('tokens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

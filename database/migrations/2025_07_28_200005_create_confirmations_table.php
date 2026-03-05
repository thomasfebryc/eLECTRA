<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->string('bukti_transfer')->nullable(); // File bukti
            $table->text('catatan')->nullable();          // Optional note dari user
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Status admin
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('confirmations');
    }
};

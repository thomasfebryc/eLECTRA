<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('konten');
        $table->enum('tipe', ['promo', 'informasi'])->default('informasi');
        $table->timestamp('mulai_aktif')->nullable();
        $table->timestamp('selesai_aktif')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};

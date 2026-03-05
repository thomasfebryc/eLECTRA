<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            // Hanya tambahkan foreign key jika belum ada
            if (!\Schema::hasColumn('bills', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            // Tambahkan constraint FK (bisa menyebabkan error kalau sudah ada)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            if (\Schema::hasColumn('bills', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
}

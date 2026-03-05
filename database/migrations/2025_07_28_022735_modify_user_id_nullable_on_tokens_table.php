<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tokens', function (Blueprint $table) {
            // Pertama, hapus foreign key-nya jika ada
            if (Schema::hasColumn('tokens', 'user_id')) {
                $table->dropForeign(['user_id']); // HARUS sebelum dropColumn
                $table->dropColumn('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};

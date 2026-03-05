<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tokens', function (Blueprint $table) {
            if (Schema::hasColumn('tokens', 'user_id')) {
                // Drop foreign key jika ada
                try {
                    $table->dropForeign(['user_id']);
                } catch (\Exception $e) {
                    // Lewati jika foreign key sudah tidak ada
                }

                // Drop kolom
                $table->dropColumn('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            if (!Schema::hasColumn('tokens', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
};

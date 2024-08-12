<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key jika ada
            if (Schema::hasColumn('users', 'id_level_user')) {
                $table->dropForeign(['id_level_user']);
                $table->dropColumn('id_level_user');
            }
        });
    }

    public function down()
    {
        // Tidak perlu implementasi down karena ini adalah fix
    }
};
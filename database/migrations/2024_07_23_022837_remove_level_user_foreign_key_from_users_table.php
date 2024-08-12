<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLevelUserForeignKeyFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_level_user']);
            $table->dropColumn('id_level_user');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_level_user');
            $table->foreign('id_level_user')->references('id')->on('level_users');
        });
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kalender_beasiswa', function (Blueprint $table) {
            $table->string('link_pendaftaran')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('kalender_beasiswa', function (Blueprint $table) {
            $table->dropColumn('link_pendaftaran');
        });
    }
    
};

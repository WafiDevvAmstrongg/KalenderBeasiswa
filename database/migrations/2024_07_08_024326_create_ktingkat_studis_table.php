<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ktingkat_studis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kbeasiswa');
            $table->unsignedBigInteger('id_tingkat_studi');
            $table->timestamps();

            $table->foreign('id_kbeasiswa')->references('id')->on('kalender_beasiswas');
            $table->foreign('id_tingkat_studi')->references('id')->on('tingkat_studis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktingkat_studis');
    }
};

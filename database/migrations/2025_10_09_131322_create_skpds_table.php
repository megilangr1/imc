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
        Schema::create('skpds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('kode_skpd');
            $table->string('nama_skpd');
            $table->string('kode_kelompok_skpd')->nullable();
            $table->string('nama_kelompok_skpd')->nullable();
            $table->tinyInteger('tingkat')->default(1);
            $table->foreignId('id_creator')->nullable();
            $table->string('nama_creator')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpds');
    }
};
